lista_compra = []


def limpiar_nombre(nombre):
    return nombre.lower().replace(" ", "")


def anadir_producto():
    nombre = input("Introduce el nombre del producto a añadir: ")
    nombre_limpio = limpiar_nombre(nombre)

    if not nombre_limpio:
        print(" El nombre del producto no puede estar vacío.")
        return

    # Comprobar si ya está en la lista (búsqueda)
    # Usamos el nombre_limpio para la comprobación
    if nombre_limpio in lista_compra:
        print(f"Cuidado '{nombre.capitalize()}' ya está en la lista.")
    else:
        # Añadir a la lista
        lista_compra.append(nombre_limpio)
        print(f"'{nombre.capitalize()}' añadido a la lista.")


def eliminar_producto():
    nombre = input("Introduce el nombre del producto a eliminar: ")
    nombre_limpio = limpiar_nombre(nombre)

    if nombre_limpio in lista_compra:
        lista_compra.remove(nombre_limpio)
        print(f" '{nombre.capitalize()}' eliminado de la lista.")
    else:
        print(f" Error: '{nombre.capitalize()}' no está en la lista de la compra.")


def ver_lista():
    if not lista_compra:
        print("La lista de la compra está vacía.")
    else:
        print("LISTA DE LA COMPRA ".format(len(lista_compra)))

        lista_ordenada = sorted(lista_compra)

        for i, producto_limpio in enumerate(lista_ordenada, 1):
            print(f"{i}. {producto_limpio.capitalize()}")

        print("-------------------------------------------\n")


def vaciar_lista():
    if not lista_compra:
        print("La lista ya está vacía.")
        return

    confirmacion = input("¿Quieres vaciar toda la lista? (s/n): ").lower()

    # Pedir confirmación
    if confirmacion == 's':
        # Usar clear()
        lista_compra.clear()
        print("Lista de la compra vaciada.")
    elif confirmacion == 'n':
        print("Operación cancelada, la lista no se ha vaciado.")
    else:
        print("Opción no válida, la lista no se ha vaciado.")


def mostrar_menu():
    print("GESTOR DE LISTA DE LA COMPRA")
    print("1. Añadir producto")
    print("2. Eliminar producto")
    print("3. Ver lista")
    print("4. Vaciar lista")
    print("5. Salir")


def iniciar_programa():
    """Función principal que contiene el bucle del programa."""

    # Bucle principal para mantener el programa en ejecución
    while True:
        mostrar_menu()
        opcion = input("Elige una opción (1-5): ")

        if opcion == '1':
            anadir_producto()
        elif opcion == '2':
            eliminar_producto()
        elif opcion == '3':
            ver_lista()
        elif opcion == '4':
            vaciar_lista()
        elif opcion == '5':
            print("Saliendo de la lista de la compra.")
            break  # Termina el bucle y el programa
        else:
            print("Opción no válida. Por favor, elige un número del 1 al 5.")

if __name__ == "__main__":
    iniciar_programa()