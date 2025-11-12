import uuid

class Tarea:

    def __init__(self, titulo, descripcion):
        self.id = uuid.uuid4()
        self.titulo = titulo
        self.descripcion = descripcion
        self.completada = False

    def mostrar_info(self):
        estado = " COMPLETADA" if self.completada else "PENDIENTE"
        return f"[{estado}] Título: **{self.titulo.capitalize()}** (ID: {str(self.id)[:4]}...)"

    def marcar_completada(self):
        if not self.completada:
            self.completada = True
            return True
        return False

    def editar(self, nuevo_titulo, nueva_descripcion):
        self.titulo = nuevo_titulo
        self.descripcion = nueva_descripcion

tareas = []
def crear_tarea():
    print(" CREAR TAREA")
    titulo = input("Introduce el título de la tarea: ").strip()
    descripcion = input("Introduce la descripción: ").strip()

    if not titulo:
        print("El título no puede estar vacío.")
        return

    nueva_tarea = Tarea(titulo, descripcion)
    tareas.append(nueva_tarea)
    print(f"Tarea '{titulo}' creada con éxito.")


def buscar_tarea_por_titulo(titulo_buscado):

    titulo_buscado_lower = titulo_buscado.lower()

    for tarea in tareas:
        if tarea.titulo.lower() == titulo_buscado_lower:
            return tarea
    return None

def mostrar_todas():
    print("LISTA DE TAREAS")
    if not tareas:
        print("No hay tareas pendientes")
        return

    for i, tarea in enumerate(tareas, 1):
        print(f"{i}. {tarea.mostrar_info()}")
    print("-------")


def marcar_como_completada():
    titulo_buscado = input("Introduce el título de la tarea a marcar como completada: ").strip()
    tarea = buscar_tarea_por_titulo(titulo_buscado)

    if tarea:
        if tarea.marcar_completada():
            print(f"Tarea '{tarea.titulo.capitalize()}' marcada como completada.")
        else:
            print(f"La tarea '{tarea.titulo.capitalize()}' ya estaba completada.")
    else:
        print(f"Tarea con título '{titulo_buscado}' no encontrada.")


def editar_tarea():
    titulo_buscado = input("Introduce el título de la tarea a editar: ").strip()
    tarea = buscar_tarea_por_titulo(titulo_buscado)

    if tarea:
        print(f" Editando: {tarea.titulo} ---")
        nuevo_titulo = input(f"Nuevo título (actual: {tarea.titulo}): ").strip()
        nueva_descripcion = input(f"Nueva descripción (actual: {tarea.descripcion}): ").strip()

        titulo_final = nuevo_titulo if nuevo_titulo else tarea.titulo
        descripcion_final = nueva_descripcion if nueva_descripcion else tarea.descripcion

        tarea.editar(titulo_final, descripcion_final)
        print(f"Tarea '{titulo_final.capitalize()}' editada con éxito.")
    else:
        print(f"Tarea con título '{titulo_buscado}' no encontrada.")


def eliminar_tarea():
    titulo_buscado = input("Introduce el título de la tarea a eliminar: ").strip()
    tarea_a_eliminar = buscar_tarea_por_titulo(titulo_buscado)

    if tarea_a_eliminar:
        tareas.remove(tarea_a_eliminar)
        print(f"Tarea '{tarea_a_eliminar.titulo.capitalize()}' eliminada.")
    else:
        print(f"Tarea con título '{titulo_buscado}' no encontrada.")


def mostrar_menu():

    print("GESTOR DE TAREAS")
    print("1. Crear tarea")
    print("2. Mostrar todas")
    print("3. Marcar como completada")
    print("4. Editar tarea")
    print("5. Eliminar tarea")
    print("6. Salir")
    print("-----------")


def iniciar_programa():
    while True:
        mostrar_menu()
        opcion = input("Elige una opción (1-6): ")

        if opcion == '1':
            crear_tarea()
        elif opcion == '2':
            mostrar_todas()
        elif opcion == '3':
            marcar_como_completada()
        elif opcion == '4':
            editar_tarea()
        elif opcion == '5':
            eliminar_tarea()
        elif opcion == '6':
            print("Saliendo del gestor de tareas")
            break
        else:
            print("Opción no válida. Por favor, elige un número del 1 al 6.")

if __name__ == "__main__":
    iniciar_programa()