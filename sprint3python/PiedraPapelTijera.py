import random
import time

REGLAS_JUEGO = {
    "tijera": ["papel", "lagarto"], 
    "papel": ["piedra", "spock"],
    "piedra": ["tijera", "lagarto"],
    "lagarto": ["spock", "papel"],
    "spock": ["tijera", "piedra"],
}
OPCIONES = list(REGLAS_JUEGO.keys())


def obtener_mejor_de_n():

    print("\n--- 6. Mejor de N ---")
    while True:
        try:
            n_input = input("¿Al mejor de cuántas rondas quieres jugar? (Introduce un número impar, ej: 3 o 5): ")
            n = int(n_input)
            if n >= 1 and n % 2 != 0:
                rondas_necesarias = n // 2 + 1
                print(f"La partida será al mejor de {n}. El primero en ganar {rondas_necesarias} rondas gana el juego.")
                return n, rondas_necesarias
            else:
                print("Error: Debes introducir un número impar mayor o igual que 1.")
        except ValueError:
            print("Error: Debes introducir un número entero válido.")


def determinar_resultado(jugada_usuario, jugada_cpu):
    if jugada_usuario == jugada_cpu:
        return 0

    if jugada_cpu in REGLAS_JUEGO[jugada_usuario]:
        return 1
    else:
        return -1

def jugar_ronda(max_rondas):
    puntuacion_usuario = 0
    puntuacion_cpu = 0

    N, rondas_necesarias = obtener_mejor_de_n()

    print("\n--- ¡Empieza el Juego! ---")

    while puntuacion_usuario < rondas_necesarias and puntuacion_cpu < rondas_necesarias:
        print(f"\n--- Ronda Actual: {puntuacion_usuario} - {puntuacion_cpu} (Objetivo: {rondas_necesarias}) ---")

        while True:
            jugada_usuario = input(f"Elige tu jugada ({', '.join(OPCIONES)}): ").strip().lower()
            if jugada_usuario in OPCIONES:
                break
            else:
                print(f"Jugada no válida. Por favor, elige una de estas: {', '.join(OPCIONES)}.")

        jugada_cpu = random.choice(OPCIONES)

        time.sleep(0.5)
        print(f"\nTu jugada: {jugada_usuario.upper()}")
        print(f"Jugada de la CPU: {jugada_cpu.upper()}")
        time.sleep(0.5)

        resultado = determinar_resultado(jugada_usuario, jugada_cpu)

        if resultado == 1:
            puntuacion_usuario += 1
            print("✨ ¡Punto para ti! Has ganado la ronda.")
        elif resultado == -1:
            puntuacion_cpu += 1
            print("¡Punto para la CPU! Has perdido la ronda.")
        else:
            print("¡Empate! Nadie recibe punto.")

    print("\n" + "=" * 50)
    print(f"*** RESULTADO FINAL: {puntuacion_usuario} - {puntuacion_cpu} ***")

    if puntuacion_usuario > puntuacion_cpu:
        print("¡FELICIDADES! HAS GANADO LA PARTIDA COMPLETA.")
    else:
        print("¡Oh no! La CPU ha ganado la partida. ¡Mejor suerte la próxima!")
    print("=" * 50)

def main():
    print("=" * 50)
    print("      PIEDRA, PAPEL, TIJERA, LAGARTO, SPOCK")
    print("=" * 50)
    print("Basado en el juego de la serie 'The Big Bang Theory'.")

    print("\n--- Reglas: ---")
    for jugada, gana_a in REGLAS_JUEGO.items():
        print(f"- {jugada.capitalize()} gana a {gana_a[0]} y a {gana_a[1]}.")

    while True:
        try:
            jugar_ronda(max)
        except Exception as e:
            print(f"Ocurrió un error inesperado: {e}")

        while True:
            respuesta = input("\n¿Quieres jugar otra partida? (s/n): ").strip().lower()
            if respuesta == 's':
                print("\n" + "#" * 50)
                break
            elif respuesta == 'n':
                print("\n¡Gracias por jugar! 👋 ¡Hasta la próxima!")
                return
            else:
                print("Respuesta no válida. Por favor, introduce 's' o 'n'.")

if __name__ == "__main__":
    main()
