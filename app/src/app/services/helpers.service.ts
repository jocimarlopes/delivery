import { Injectable } from '@angular/core';
import { LoadingController, ToastController } from '@ionic/angular';

@Injectable({
  providedIn: 'root'
})
export class HelpersService {

  tempo: any;
  entrega: any;
  bairro: any;

  local: any;
  paoSelecionado: any = '';

  constructor(
    public loadingController: LoadingController,
    public toast: ToastController) { }

  /**
   * Loader de Aguardando o Carregamento dos Itens
   * usar o comando abaixo para encerrar o Loader.
   * 
   * this.helpers.loadingController.dismiss();
   */
  async loader() {
    const loading = await this.loadingController.create({
      cssClass: 'loader',
      spinner: 'bubbles',
      message: 'carregando..'
    });
    await loading.present();
  }

  recebeTempo(data){
    this.tempo = data;
  }

  enviaTempo(){
    return this.tempo;
  }

  recebeValorEntrega(data) {
    this.entrega = data;
  }

  enviaValorEntrega(){
    return this.entrega;
  }

  recebeBairro(data) {
    this.bairro = data;
  }

  enviaBairro() {
    return this.bairro;
  }

  recebeLocal(data) {
    this.local = data;
  }

  enviaLocal() {
    return this.local;
  }

  recebePao(data) {
    this.paoSelecionado = data;
  }

  enviaPao() {
    return this.paoSelecionado;
  }

  async mensagem(mensagem, tempo, cor) {
    const toast = await this.toast.create({
      message: mensagem,
      duration: tempo,
      color: cor
    });
    toast.present();
  }


}
