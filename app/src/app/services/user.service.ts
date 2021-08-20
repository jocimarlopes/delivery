import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  userNome = "";
  userId = "";
  userNivel = "";
  userFoto = "";
  userCpf = "";
  userCelular = "";

  constructor() { }


  setUserNome(valor) {
    this.userNome = valor;
  }

  getUserNome() {
    return this.userNome;
  }

  setUserCpf(valor) {
    this.userCpf = valor;
  }

  getUserCpf() {
    return this.userCpf;
  }

  setUserCelular(valor) {
    this.userCelular = valor;
  }

  getUserCelular() {
    return this.userCelular;
  }

  setUserId(valor) {
    this.userId = valor;
  }
  getUserId() {
    return this.userId;
  }

  setUserNivel(valor) {
    this.userNivel = valor;
  }

  getUserNivel() {
    return this.userNivel;
  }

  setUserFoto(valor) {
    this.userFoto = valor;
  }

  getUserFoto() {
    return this.userFoto;
  }
}
