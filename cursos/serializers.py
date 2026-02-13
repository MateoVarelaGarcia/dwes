from rest_framework import serializers
from .models import Perfil, Equipo, Jugador, Partido, Desempeno
from django.contrib.auth.models import User

# Serializador para el User de Django (necesario para el Perfil)
class UserSerializer(serializers.ModelSerializer):
    class Meta:
        model = User
        fields = ['id', 'username', 'email']

# 1. Serializador de Perfil
class PerfilSerializer(serializers.ModelSerializer):
    usuario = UserSerializer(read_only=True) # Anidamos el usuario para ver su nombre

    class Meta:
        model = Perfil
        fields = '__all__'

# 2. Serializador de Equipo
class EquipoSerializer(serializers.ModelSerializer):
    class Meta:
        model = Equipo
        fields = '__all__'

# 3. Serializador de Jugador
class JugadorSerializer(serializers.ModelSerializer):
    # Esto mostrará el nombre del equipo en lugar de solo el ID
    equipo_nombre = serializers.ReadOnlyField(source='equipo.nombre')

    class Meta:
        model = Jugador
        fields = ['id', 'perfil', 'equipo', 'equipo_nombre', 'dorsal', 'posicion']

# 4. Serializador para la tabla intermedia (Desempeño)
class DesempenoSerializer(serializers.ModelSerializer):
    class Meta:
        model = Desempeno
        fields = '__all__'

    # Validación personalizada (Ejemplo Bloque 2)
    def validate_minutos_jugados(self, value):
        if value < 0 or value > 120:
            raise serializers.ValidationError("Los minutos deben estar entre 0 y 120.")
        return value