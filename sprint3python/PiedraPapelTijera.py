

opciones = ["piedra", "papel", "tijera", "lagarto", "spock"]

juego_diccionario = {
    "tijera": ["papel", "lagarto"],
    "papel": ["piedra", "spock"],
    "piedra": ["tijera", "lagarto"],
    "lagarto": ["spock", "papel"],
    "spock":["piedra", "tijera"],
}

def suma_de_puntos():
    print("\n Sumando puntos")
