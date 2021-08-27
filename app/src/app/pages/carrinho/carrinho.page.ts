import { ToastController, AlertController } from '@ionic/angular';
import { Post } from '../../services/post.service';
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { UserService } from '../../services/user.service';
import { HelpersService } from '../../services/helpers.service';
import { HorariosService } from 'src/app/services/horarios.service';

@Component({
  selector: 'app-carrinho',
  templateUrl: './carrinho.page.html',
  styleUrls: ['./carrinho.page.scss'],
})
export class CarrinhoPage implements OnInit {

  lista: any = [];
  url_site_img: string;
  limit: number = 10;
  start: number = 0;
  id: number;

  cpf: string;
  nome_cliente: string;
  telefone: string;

  total_carrinho: number;
  total_itens: string;
  dadosLogin: any;

  frete: string;
  subtotal: string;
  subtotal2: string;
  previsao: string;

  total: any;

  troco: string = '';
  rua: string = '';
  numero: string = '';
  bairro: string = '';
  cidade: string = '';
  obs: string = '';

  tipo: string;

  tempo: any;

  pedido: any;
  totalPedido: any = [];
  pedidos: any;

  encoded: any;

  valor1: any;
  valor2: any;

  botaoPedido: any;

  mensagemFinaliza: any;

  pagamento: any = '';

  constructor(public horarios: HorariosService,public helpers: HelpersService, public userService: UserService, public alertController: AlertController, private actRouter: ActivatedRoute, private router: Router, private provider: Post, public toast: ToastController) {
  }

  ngOnInit() {

  }

  logout() {
    this.router.navigate(['/login']);
  }

  ionViewWillEnter() {
    this.cpf = this.userService.getUserCpf();

    if (this.cpf === undefined) {
      this.router.navigate(['/login']);
      this.mensagemLogar();
      return;
    }

    this.lista = [];
    this.start = 0;
    this.listarCarrinho();
    this.url_site_img = this.provider.url_site_img_produtos;

    this.listarTempo();
  }

  async mensagemLogar() {
    const toast = await this.toast.create({
      message: 'Você precisa estar logado! Faça Login ou Cadastre-se!',
      duration: 4000,
      color: 'danger'
    });
    toast.present();
  }

  categorias() {
    this.router.navigate(['/categorias']);
  }

  //barra de rolagem
  loadData(event) {
    this.start += this.limit;
    setTimeout(() => {
      this.listarCarrinho().then(() => {
        event.target.complete();
      });
    }, 3000);
  }

  async mensagemSalvar(texto) {
    const toast = await this.toast.create({
      message: texto,
      duration: 2000,
      color: 'dark'
    });
    toast.present();
  }

  listarCarrinho() {
    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-carrinho',
        cpf: this.cpf,
        valorEntrega: this.helpers.entrega
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {

        this.botaoPedido = data['result'];

        if (data['result'] == '0') {
          //this.ionViewWillEnter();
        } else {
          this.lista = [];
          for (let item of data['result']) {
            this.lista.push(item);
            this.total_carrinho = data['total'];
            this.frete = this.helpers.entrega;
            this.subtotal = data['subtotal'];
            this.subtotal2 = data['subtotal2'];
            this.total_itens = data['totalItens'];
            this.previsao = data['previsao'];

            this.pedido = item;

          }
        }

        resolve(true);

      });

    });

  }

  listarCarrinho2() {
    this.totalPedido;
    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-carrinho',
        cpf: this.cpf,
        valorEntrega: this.helpers.entrega
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {

        if (data['result'] == '0') {
          this.ionViewWillEnter();
        } else {
          this.lista = [];
          for (let item of data['result']) {
            this.lista.push(item);
            this.total_carrinho = data['total'];
            this.frete = this.helpers.entrega;
            this.subtotal = data['subtotal'];
            this.subtotal2 = data['subtotal2'];
            this.total_itens = data['totalItens'];
            this.previsao = data['previsao'];

            this.pedido = item;

            this.pedidos = this.pedido.quantidade + ' - ' + this.pedido.nome;
            if (this.totalPedido.length < data['result'].length) {
              this.totalPedido.push(this.pedidos);

            }

          }
        }


        resolve(true);

      });

    });

  }

  somaTotal(id) {
    return new Promise(resolve => {

      let dados = {
        requisicao: 'soma-total',
        frete: this.frete,
        carrinho: this.total_carrinho,
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {

      });
    });
  }

  async addItem(id) {
    await this.helpers.loader();
    return new Promise(resolve => {

      let dados = {
        requisicao: 'add-item',
        id: id,
        cpf: this.cpf,
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {
        this.helpers.loadingController.dismiss();

        this.mensagemSalvar('Item Adicionado!');
        //this.listarCarrinho();
        this.ionViewWillEnter();


      });
    });
  }

  async removeItem(id) {
    await this.helpers.loader();
    return new Promise(resolve => {

      let dados = {
        requisicao: 'remove-item',
        id: id,
        cpf: this.cpf,
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {
        this.helpers.loadingController.dismiss();

        this.mensagemSalvar('Item Removido!');
        //this.listarCarrinho();
        this.ionViewWillEnter();

      });
    });
  }

  async finalizarModal() {
    this.listarCarrinho2();

    if (this.botaoPedido == '0') {
      this.mensagemSalvar('Você precisa ter produtos no carrinho');
    }
    else {
      var bairro = this.helpers.enviaLocal();

      const pagamento = await this.alertController.create({
        header: 'Finalizar Pedido!',
        message: '<b>Como vai querer pagar na entrega?</b>',
        backdropDismiss: false,
        inputs: [
          {
            type: 'radio',
            name: 'tipo',
            label: 'Dinheiro (na Entrega)',
            value: 'DINHEIRO',
            checked: true
          },
          {
            type: 'radio',
            name: 'tipo',
            label: 'Cartão (na Entrega)',
            value: 'CARTÃO'
          }

        ],

        buttons: [
          {
            text: 'Voltar',
            role: 'cancel',
            cssClass: 'secondary',
            handler: () => {
            }
          }, {
            text: 'Avançar',
            handler: (data) => {
              //atualizar pag

              this.tipo = data;
              if (this.tipo == 'CARTÃO') {
                this.pagamento = 'CARTÃO';
              }
              this.bairro = bairro.label;
              this.finalizaModal2();
            }
          }
        ]
      });

      await pagamento.present();
    }


  }

  async finalizaModal2() {

    const alert = await this.alertController.create({
      header: 'Finalizar Pedido!',
      message: 'Previsão ' + this.previsao + ' Minutos<br><b>Total</b>: R$' + this.subtotal2,
      backdropDismiss: false,
      inputs: [

        {
          name: 'troco',
          type: 'number',
          value: '',
          placeholder: 'Precisa de troco? Caso não, deixa em branco.',
          //value: this.usuario
        },

        {
          name: 'rua',
          type: 'text',
          placeholder: 'Rua',
          value: this.rua
        },

        {
          name: 'numero',
          type: 'number',
          placeholder: 'Número',
          value: this.numero
        },

        {
          name: 'bairro',
          type: 'text',
          placeholder: 'Bairro',
          value: this.bairro,
          disabled: true
        },
        {
          name: 'obs',
          type: 'textarea',
          placeholder: 'Observações',
          value: this.obs
        },

      ],

      buttons: [
        {
          text: 'Voltar',
          role: 'cancel',
          cssClass: 'secondary',
          handler: () => {
            this.finalizarModal();
          }
        }, {
          text: 'Fazer Pedido',
          handler: (data) => {
            //atualizar pag

            this.troco = data.troco;
            this.rua = data.rua;
            this.numero = data.numero;
            this.bairro = data.bairro;
            this.cidade = 'CIDADE';
            this.obs = data.obs;
            this.nome_cliente = this.userService.getUserNome();
            this.telefone = this.userService.getUserCelular();

            if (this.troco == '') {
              this.troco == this.subtotal2
            }
            if (this.pagamento == 'CARTÃO') {
              this.troco == this.subtotal2
            }
            if (this.rua == '') {
              this.mensagemSalvar('Preencha todos os campos, finalize o pedido novamente');

            }
            if (this.numero == '') {
              this.mensagemSalvar('Preencha todos os campos, finalize o pedido novamente');

            }
            if (this.bairro == '') {
              this.mensagemSalvar('Preencha todos os campos, finalize o pedido novamente');

            }
            else {
              if (this.obs == '') {
                this.obs = '*Sem* *referências*'
              }
              this.finalizar();

            }
          }
        }
      ]
    });

    await alert.present();
  }

  async finalizar() {
    let hora = await this.horarios.pegarHoraAtual() + ':' + this.horarios.pegarMinutoAtual();
    await this.encodeUrl();
    return new Promise(resolve => {

      let dados = {
        requisicao: 'finalizar-pedido',
        cpf: this.cpf,
        obs: this.obs,
        troco: this.troco,
        tipo: this.tipo,
        total: this.subtotal,
        nome_cliente: this.nome_cliente,
        telefone: this.telefone, // NÃO ESTÁ PEGANDO O TELEFONE, O TELEFONE VAI PARA O 'NOME', E NO 'TELEFONE' É TUDO ALEATÓRIO
        rua: this.rua,
        hora: hora,
        numero: this.numero,
        bairro: this.bairro,
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {
        if (data['texto'] == 'Pedido Concluído!') {
          this.mensagemFinaliza = data['texto'];
          this.goWhatsapp();
        }
        else {
          this.mensagemSalvar(data['texto']);
        }

      });
    });
  }

  listarTempo() {
    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-tempo',
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {

        this.tempo = data;

        resolve(true);

      });

    });

  }

  encodeUrl() {
    this.encoded = '%0A ' + this.totalPedido.join(' %0A ') + ' %0A ';
  }

  async goWhatsapp() {
    const alert = await this.alertController.create({
      header: 'Atenção!',
      message: 'Show! Guardamos o seu pedido, já já estaremos enviando! Por favor, envie uma mensagem confirmando o Pedido via Whatsapp!<br><br>Aperte em <b>Enviar</b> para continuar! Obrigado',
      backdropDismiss: false,
      buttons: [
        {
          text: 'Enviar',
          handler: () => {

            window.open("https://api.whatsapp.com/send?phone=55" + this.tempo.contato + "&text=*NOVO*%20*PEDIDO*%20*REALIZADO:*%20%0A%0A*Cliente%3A*%0A" + this.userService.getUserNome() + '%0ARua ' + this.rua + ', ' + this.numero + '%0A' + this.bairro + "%0A%0A" + "Referência: " + this.obs + "%0A%0A*PEDIDO:*%0A" + this.encoded + '%0A%0A' + '*Pagar* *com:* *' + this.tipo + '*%0A*Total:* *R$* ' + '*' + this.subtotal2 + '*' + '%0A*Troco* *para:* *R$' + this.troco + ',00*' + '%0A%0A============%0A*Sistema* *Delivery*%0Apor *Home* *Company*');
            location.reload();
          }
        }
      ]
    });

    await alert.present();

  }

}
