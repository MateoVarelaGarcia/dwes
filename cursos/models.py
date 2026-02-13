from django.db import models
from django.contrib.auth.models import User
from django.db.models import UniqueConstraint


# 1. Relación 1:1 - Perfil de Usuario (Extensión)
class Perfil(models.Model):
    usuario = models.OneToOneField(User, on_delete=models.CASCADE)
    biografia = models.TextField(blank=True, verbose_name="Bio")
    avatar_url = models.CharField(max_length=255, blank=True)
    fecha_nacimiento = models.DateField(null=True, blank=True)

    class Meta:
        verbose_name = "Perfil de Usuario"


# 2. Relación 1:N - Un Equipo tiene muchos Jugadores
class Equipo(models.Model):
    nombre = models.CharField(max_length=100, unique=True)
    ciudad = models.CharField(max_length=100)
    es_profesional = models.BooleanField(default=False)
    created_at = models.DateTimeField(auto_now_add=True)

    class Meta:
        verbose_name_plural = "Equipos"
        ordering = ['nombre']

    def __str__(self):
        return self.nombre


# 3. Relación 1:N - Jugador pertenece a un Equipo
class Jugador(models.Model):
    perfil = models.OneToOneField(Perfil, on_delete=models.CASCADE)
    equipo = models.ForeignKey(Equipo, on_delete=models.SET_NULL, null=True, related_name="jugadores")
    dorsal = models.IntegerField()
    posicion = models.CharField(max_length=50, help_text="Ej: Delantero, Portero")

    def __str__(self):
        return f"{self.perfil.usuario.username} - {self.equipo}"


# 4. Modelo para Partidos (Relación N:M hacia Jugadores)
class Partido(models.Model):
    rivales = models.ManyToManyField(Equipo, related_name="encuentros")
    fecha = models.DateTimeField()
    estadio = models.CharField(max_length=200)

    # Relación N:M con atributos extra (Goles, Minutos)
    participantes = models.ManyToManyField(Jugador, through='Desempeno')

    class Meta:
        ordering = ['-fecha']


# 5. Modelo Intermedio (Through) con Restricciones
class Desempeno(models.Model):
    jugador = models.ForeignKey(Jugador, on_delete=models.CASCADE)
    partido = models.ForeignKey(Partido, on_delete=models.CASCADE)

    goles = models.IntegerField(default=0)
    minutos_jugados = models.DecimalField(max_digits=5, decimal_places=2)
    tarjeta_amarilla = models.BooleanField(default=False)

    class Meta:
        # RESTRICCIÓN: Un jugador no puede tener dos registros en el mismo partido
        constraints = [
            UniqueConstraint(fields=['jugador', 'partido'], name='unique_participacion_partido')
        ]
        verbose_name = "Estadística de Partido"


