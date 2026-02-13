from django.shortcuts import render
from rest_framework import viewsets
from .models import Equipo, Jugador, Partido, Desempeno
from .serializers import EquipoSerializer, JugadorSerializer, DesempenoSerializer

class EquipoViewSet(viewsets.ModelViewSet):
    queryset = Equipo.objects.all()
    serializer_class = EquipoSerializer

class JugadorViewSet(viewsets.ModelViewSet):
    queryset = Jugador.objects.all()
    serializer_class = JugadorSerializer

class DesempenoViewSet(viewsets.ModelViewSet):
    queryset = Desempeno.objects.all()
    serializer_class = DesempenoSerializer