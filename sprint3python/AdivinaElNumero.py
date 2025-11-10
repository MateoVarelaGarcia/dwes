import random
import time

def seleccionar_nivel():
    print("\n Elegir Nivel de Dificultad")
    while True:
        nivel = input("Elige el nivel (fácil/medio/difícil): ").strip().lower()

        if nivel == "fácil" or nivel == "facil":
            max_num = 50
            break
        elif nivel == "medio":
            max_num = 100
            break
        elif nivel == "difícil" or nivel == "dificil":
            max_num = 500
            break
        else:
            print("Nivel no válido. Intenta de nuevo con 'fácil', 'medio' o 'difícil'.")
            time.sleep(0.5)

    print(f"Nivel elegido: El número secreto estará entre 1 y {max_num}")
    numero_secreto = random.randint(1, max_num)
    print("El número secreto ha sido generado.")
    return numero_secreto, max_num

def jugar_adivina_numero():
    print("=" * 40)
    print("      ADIVINA EL NÚMERO")
    print("=" * 40)
    print("El programa pensará un número secreto. Intenta adivinarlo.")
    time.sleep(1)

    numero_secreto, max_num = seleccionar_nivel()

    intentos = 0
    adivinado = False

    while not adivinado:
        intentos += 1

        while True:
            try:
                intento_usuario = int(input(f"\nIntento #{intentos}: Introduce un número entre 1 y {max_num}: "))
                break
            except ValueError:
                print("🚨 Error: Debes introducir un número entero válido.")

        if intento_usuario < numero_secreto:
            print("Demasiado bajo. Intenta con un número mayor.")
        elif intento_usuario > numero_secreto:
            print("Demasiado alto. Intenta con un número menor.")
        else:
            print("\n Felicidades")
            print(f"Adivinaste el número secreto ({numero_secreto}) en **{intentos}** intentos.")
            adivinado = True

def main():
    while True:
        jugar_adivina_numero()

        while True:
            respuesta = input("\n¿Quieres jugar otra vez? (s/n): ").strip().lower()
            if respuesta == 's':
                print("-" * 40)
                break
            elif respuesta == 'n':
                print("\n¡Gracias por jugar! 👋 ¡Hasta la próxima!")
                return
            else:
                print("Respuesta no válida. Por favor, introduce 's' o 'n'.")

if __name__ == "__main__":
    main()