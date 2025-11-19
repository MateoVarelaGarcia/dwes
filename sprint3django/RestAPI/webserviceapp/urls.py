# webserviceapp/urls.py

from django.urls import path
from . import views

urlpatterns = [

    path('canciones', views.devolver_peliculas),

    path('canciones/<int:id_solicitado>', views.devolver_pelicula_por_id),

    path('canciones/<int:id_solicitado>/comentarios', views.publicar_comentario),
]
