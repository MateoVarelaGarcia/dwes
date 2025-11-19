from django.shortcuts import render

# Create your views here.

from django.http import JsonResponse, HttpResponse
from .models import Tpeliculas, Tcomentarios
import json
from django.shortcuts import get_object_or_404
from django.views.decorators.csrf import csrf_exempt


def devolver_peliculas(request):

    lista = Tpeliculas.objects.all()
    respuesta_final = []
    
    for pelicula_sql in lista:
        diccionario = {
            'id': pelicula_sql.id,
            'titulo': pelicula_sql.nombre,
            'año': pelicula_sql.año, 
            'director': pelicula_sql.director, 
        }
        respuesta_final.append(diccionario)

    return JsonResponse(respuesta_final, safe=False)


def devolver_pelicula_por_id(request, id_solicitado):

    pelicula = get_object_or_404(Tpeliculas, id=id_solicitado)

    comentarios_sql = pelicula.tcomentarios_set.all() 

    lista_comentarios = []
    for comentario in comentarios_sql:
        lista_comentarios.append({
            'id': comentario.id,
            'comentario': comentario.comentario,
        })
        
    resultado = {
        'id': pelicula.id,
        'titulo': pelicula.nombre,
        'año': pelicula.año, 
        'director': pelicula.director,
        'comentarios': lista_comentarios
    }
    
    return JsonResponse(resultado, json_dumps_params={'ensure_ascii': False})

@csrf_exempt
def publicar_comentario(request, id_solicitado):

    if request.method == 'POST':

        pelicula = get_object_or_404(Tpeliculas, id=id_solicitado)

        try:
            datos_json = json.loads(request.body)

            comentario_texto = datos_json.get('nuevo_comentario') 
        except json.JSONDecodeError:
            return JsonResponse({'error': 'JSON inválido'}, status=400)


        if comentario_texto:
            nuevo_comentario = Tcomentarios(
                comentario=comentario_texto,
                pelicula=pelicula
            )
            nuevo_comentario.save()

            return JsonResponse({}, status=200)
        else:
            return JsonResponse({'error': 'Falta el campo nuevo_comentario'}, status=400)

    return JsonResponse({'error': 'Método no permitido'}, status=405)
