import time

CUENTA = {
    "nombre": "Ana Pérez",
    "saldo": 1200.50
}


def mostrar_saldo():
    print("-" * 30)
    print("CONSULTA DE SALDO")
    print(f"El saldo actual de {CUENTA['nombre']} es: €{CUENTA['saldo']:.2f}")
    print("-" * 30)
    time.sleep(1.0)

def obtener_cantidad_valida(tipo_operacion):
    while True:
        try:
            cantidad_str = input(f"Introduce la cantidad a {tipo_operacion}: €")
            cantidad = float(cantidad_str)

            if cantidad <= 0:
                print("Error: La cantidad debe ser positiva.")
            else:
                return cantidad
        except ValueError:
            print("Error: Por favor, introduce un valor numérico válido.")

def ingresar_dinero():
    print("-" * 30)
    print("INGRESAR DINERO")

    cantidad_a_ingresar = obtener_cantidad_valida("ingresar")

    CUENTA["saldo"] += cantidad_a_ingresar
    print(f"Ingreso exitoso de €{cantidad_a_ingresar:.2f}.")
    mostrar_saldo()

def retirar_dinero():
    print("-" * 30)
    print("RETIRAR DINERO")

    cantidad_a_retirar = obtener_cantidad_valida("retirar")

    if cantidad_a_retirar > CUENTA["saldo"]:
        print("Saldo insuficiente.")
        mostrar_saldo()
    else:
        CUENTA["saldo"] -= cantidad_a_retirar
        print(f"Retiro exitoso de €{cantidad_a_retirar:.2f}.")
        mostrar_saldo()

def mostrar_menu():
    print("\n" + "=" * 30)
    print(f"  Cajero Automático - {CUENTA['nombre']}")
    print("=" * 30)
    print("1. Consultar saldo")
    print("2. Ingresar dinero")
    print("3. Retirar dinero")
    print("4. Salir")
    print("=" * 30)


def cajero_automatico():
    while True:
        mostrar_menu()

        opcion = input("Elige una opción (1-4): ").strip()

        if opcion == '1':
            mostrar_saldo()

        elif opcion == '2':
            ingresar_dinero()

        elif opcion == '3':
            retirar_dinero()

        elif opcion == '4':
            print("\nGracias por usar nuestro Cajero. ¡Hasta pronto!")
            break

        else:
            print("Opción no válida. Por favor, introduce un número del 1 al 4.")
            time.sleep(1)


if __name__ == "__main__":
    cajero_automatico()