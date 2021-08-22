import { Injectable } from '@angular/core';
import { HelpersService } from './helpers.service';
import { Post } from './post.service';

@Injectable({
  providedIn: 'root'
})
export class HorariosService {

  hoje: any;
  dia: any;

  hora: number;
  minuto: number;

  constructor(
    public post: Post,
    public helper: HelpersService
  ) {}

  /**
   * Pega Hora Atual
   */
  pegarHoraAtual() {
    var date = new Date();
    this.hora = date.getHours();
    return this.hora;
  }


  /**
   * Pegar Minuto Atual
   */
  pegarMinutoAtual() {
    var date = new Date();
    this.minuto = date.getMinutes();
    return this.minuto;
  }

  /**
   * Pegar Hora Abertura
   */
  pegarHoraAbertura() {
    var horaAbertura = parseInt(this.dia.horario_inicio.slice(0,2));
    return horaAbertura;
  }

  /**
   * Pegar Minuto Abertura
   */
  pegarMinutoAbertura() {
    var minutoAbertura = parseInt(this.dia.horario_inicio.slice(3,5));
    return minutoAbertura;
  }

  /**
   * Pegar Hora Fechamento
   */
  pegarHoraFechamento() {
    var horaFechamento = parseInt(this.dia.horario_final.slice(0,2));
    return horaFechamento;
  }

  /**
   * Pegar Minuto Fechamento
   */
  pegarMinutoFechamento() {
    var minutoFechamento = parseInt(this.dia.horario_final.slice(3,5));
    return minutoFechamento;
  }

  /**
   * Pegar Dia Atual do Dispositivo Conectado
   * Return Number = 0, 1, 2, 3, 4, 5 OR 6
   */
  async pegarDiaAtual() {
    var date = await new Date();
    this.hoje = await date.getDay();

    //this.listarHorarios(this.hoje);
  }

  /**
   * Pegar Dia Atual
   */
  getDia() {
    return this.dia;
  }

  /**
   * Setar Dia Atual
   */
  setDia(data) {
    this.dia = data;
  }

}
