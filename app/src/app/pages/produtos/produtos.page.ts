import { Post } from '../../services/post.service';
import { Component, OnInit } from '@angular/core';
import { ToastController, AlertController, ModalController } from '@ionic/angular';
import { Router } from '@angular/router';
import { UserService } from '../../services/user.service';
import { HelpersService } from '../../services/helpers.service';
import { HorariosService } from '../../services/horarios.service';
import { StorageService } from 'src/app/services/storage.service';

@Component({
  selector: 'app-produtos',
  templateUrl: './produtos.page.html',
  styleUrls: ['./produtos.page.scss'],
})
export class ProdutosPage implements OnInit {


  lista: any = [];
  url_site_img: string;
  limit: number = 10;
  start: number = 0;
  id: number;
  total_itens: number = 0;
  cpf: string = '';
  nome: string = '';

  newDescricao: string;
  tempo: any;

  segment: any = '';

  categ: any = []; // Categ == Categorias

  statusTempo: any;

  total_carrinho: string;
  dadosLogin: any;

  locais: any = [];

  valorEntrega: any = 12.00;

  entrega: any = [];

  constructor(
    public helpers: HelpersService,
    public modalController: ModalController,
    public alertCtrl: AlertController,
    public userService: UserService,
    private router: Router,
    private provider: Post,
    public toast: ToastController,
    public horarios: HorariosService,
    public storage: StorageService

  ) {
    this.listarTempo();
    this.listarCategorias();
    this.url_site_img = this.provider.url_site_img_produtos;
    this.horarios.pegarHoraAtual();
    this.listarCarrinho();
  }

  async ngOnInit() {
    await this.getStorage();
    await this.listarLocais();
  }

  async comecar() {
    if (this.statusTempo == 0) {
      console.log('fechado, 1')
      this.fechado();
    }
    else {
      if (this.horarios.pegarHoraAtual() < this.horarios.pegarHoraAbertura() && this.horarios.pegarHoraAtual() > 6) {
        this.statusTempo == 0
        console.log('fechado, 2')
        this.fechado();
      }
      else if (this.horarios.pegarHoraAtual() < this.horarios.pegarHoraFechamento() && this.horarios.pegarHoraFechamento() < 24 && this.horarios.pegarHoraAtual() < this.horarios.pegarHoraAbertura() && this.horarios.pegarHoraFechamento() > 12) {
        this.statusTempo == 0;
        this.fechado();
      console.log('fechado, 3')
      }
      else if (this.horarios.pegarHoraAtual() < 6 && this.horarios.pegarHoraAtual() > this.horarios.pegarHoraFechamento()) {
        this.statusTempo == 0
        this.fechado();
      console.log('fechado, 4')
      }
      else if (this.horarios.pegarHoraAtual() > 6 && this.horarios.pegarHoraAtual() > this.horarios.pegarHoraFechamento() && this.horarios.pegarHoraFechamento() > 6) {
        this.statusTempo == 0
        this.fechado();
      console.log('fechado, 5')
      }
      else if (this.horarios.pegarHoraAtual() == this.horarios.pegarHoraAbertura() && this.horarios.pegarMinutoAtual() < this.horarios.pegarMinutoAbertura()) {
        this.statusTempo == 0
        this.fechado();
      console.log('fechado, 6')
      }
      else if (this.horarios.pegarHoraAtual() >= this.horarios.pegarHoraFechamento() && this.horarios.pegarMinutoAtual() >= this.horarios.pegarMinutoFechamento() && this.horarios.pegarHoraAtual() < 6) {
        this.statusTempo == 0
        this.fechado();
      console.log('fechado, 7')
      }
      else if (this.horarios.pegarHoraAtual() > this.horarios.pegarHoraFechamento() && this.horarios.pegarMinutoAtual() < this.horarios.pegarMinutoFechamento() && this.horarios.pegarHoraAtual() < 6) {
        this.statusTempo == 0
        this.fechado();
      console.log('fechado, 8')
      }
      else if (this.horarios.pegarHoraAtual() > this.horarios.pegarHoraFechamento() && this.horarios.pegarHoraAtual() < 6) {
        this.statusTempo == 0
        this.fechado();
      console.log('fechado, 9')
      }
      else if (this.horarios.pegarHoraAtual() > this.horarios.pegarHoraFechamento() && this.horarios.pegarMinutoAtual() >= this.horarios.pegarMinutoFechamento() && this.horarios.pegarHoraAtual() < 6) {
        this.statusTempo == 0
        this.fechado();
      console.log('fechado, 10')
      }
      else {
        if (this.cpf === undefined || this.cpf === '') {
          this.nomeCpf();
        }
        else {
          if (parseInt(this.total_carrinho) > 0) {
            this.router.navigate(['/carrinho']);
          }
          else {
            this.listarCarrinho();
            this.helpers.mensagem('Ol?? ' + this.userService.getUserNome() + ', adicione algo ao carrinho', 2000, 'dark');
          }
        }
      }
    }
  }

  logout() {
    //this.storage.clear();
    this.router.navigate(['/login']);
  }

  async listarProdutos() {
    this.limit = 10;
    this.start = 0;
    await this.helpers.loader();
    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-produtos',
        limit: this.limit,
        start: this.start,
        id_cat: this.segment,
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {
        this.helpers.loadingController.dismiss();

        if (data['result'] == '0') {
        } else {
          this.lista = [];
          for (let item of data['result']) {
            this.lista.push(item);
            this.total_itens = data['total'];

          }
        }

        resolve(true);

      });

    });

  }

  async refreshProdutos() {
    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-produtos',
        limit: this.limit,
        start: this.start,
        id_cat: this.segment,
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {

        if (data['result'] == '0') {
        } else {
          for (let item of data['result']) {
            this.lista.push(item);
            this.total_itens = data['total'];

          }
        }

        resolve(true);

      });

    });

  }

  async listarTempo() {

    var date = await new Date();
    var id = await date.getDay();

    if (this.horarios.pegarHoraAtual() >= 0 && this.horarios.pegarHoraAtual() < 6) {
      var id = id - 1;
      if (id < 0) {
        id = 6;
      }
    }
    let dados = {
      requisicao: 'listar-horario',
      id_dia: id
    };
    this.provider.dadosApi(dados, 'apiHorarios.php').subscribe(data => {
      this.horarios.setDadosDia(data['result'][0]);
      this.statusTempo = data['result'][0]['status'];
      this.comecar();
    });
  }

  categorias() {
    this.router.navigate(['/categorias']);
  }

  //barra de rolagem
  loadData(event) {

    this.start += this.limit;
    setTimeout(() => {
      this.refreshProdutos().then(() => {
        event.target.complete();
      });
    }, 3000);
  }

  async mensagemSalvar() {
    const toast = await this.toast.create({
      message: 'Adicionado ao Carinho!',
      duration: 500,
      color: 'primary'
    });
    toast.present();
  }

  async mensagemPadrao(mensagem, tempo, cor) {
    const toast = await this.toast.create({
      message: mensagem,
      duration: tempo,
      color: cor
    });
    toast.present();
  }

  async mensagemLogar() {
    const toast = await this.toast.create({
      message: 'Fa??a Login ou Cadastre-se.',
      duration: 3000,
      color: 'dark'
    });
    toast.present();
  }

  async nomeCpf() {

    const alert = await this.alertCtrl.create({
      header: 'Por favor, preencha os campos abaixo',
      inputs: [
        {
          name: 'nome',
          type: 'text',
          placeholder: 'Digite seu Nome',
          value: this.nome
        },
        {
          name: 'celular',
          type: 'number',
          placeholder: '(51) 9 9999.9999',
          value: this.cpf
        },
      ],
      buttons: [
        {
          text: 'Pr??ximo',
          handler: (data) => {
            if (data.nome != "" || data.celular != "") {
              if (data.celular.length == 9 || data.celular.length == 11 || data.celular.length == 12) {

                //Storage Services
                var date = Date();
                this.storage.set('user', JSON.stringify(data));
                this.storage.set('token', btoa(date));


                this.userService.setUserCpf(data.celular);
                this.userService.setUserCelular(data.celular);
                this.cpf = data.celular;
                this.userService.setUserNome(data.nome);
                this.nome = data.nome;
                this.listarCarrinho();
                this.bairros();
              }
              else {
                this.mensagemPadrao('Preencha corretamente os campos!', 1500, 'warning');
                this.comecar();
              }
            }
            else {
              this.mensagemPadrao('Preencha corretamente os campos!', 1500, 'warning');
              this.comecar();
            }
          }
        }
      ]
    });

    await alert.present();
  }

  addCarrinho(data) {
    if (this.statusTempo == 1) {/* 
      if(data.produto_categoria_id == 18 && this.helpers.enviaPao() == '') {
        this.listarPao(data);
      }
      else { */
      return new Promise(resolve => {

        let dados = {
          requisicao: 'add-carrinho',
          id_produto: data.id,
          cpf: this.cpf,

        };

        this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {

          this.mensagemSalvar();
          this.listarCarrinho();

        });
      });
      /* } */

    } else {
      this.fechado();
    }
  }

  listarCarrinho() {
    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-carrinho',
        cpf: this.cpf,
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {


        this.total_carrinho = data['total'];


        resolve(true);

      });

    });

  }

  async verDescricao(produto) {
    this.newDescricao = produto.descricao_longa.split(", ").join("<br>");
    const alert = await this.alertCtrl.create({
      cssClass: 'descricao',
      header: produto.nome,
      /* subHeader: '?? uma del??cia, viu? ', */
      message: '<b>Descri????o: </b><br>' + this.newDescricao + '<br><br>' + '<img class="descricao-img" src="' + this.url_site_img + produto.image + '">',
      buttons: ['Fechar']
    });

    await alert.present();
  }

  async fechado() {
    const alert = await this.alertCtrl.create({
      cssClass: 'descricao',
      header: "Boa noite!",
      subHeader: 'Estamos fechados',
      message: 'Infelizmente n??o estamos atendendo agora! Obrigado',
      buttons: ['Ok, obrigado']
    });

    await alert.present();
  }

  segmentChanged(ev: any) {
    this.segment = ev.detail.value;
    this.listarProdutos();
  }


  listarCategorias() {
    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-cat',
        limit: this.limit,
        start: this.start
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {

        if (data['result'] == '0') {
          console.log('error get categorias');
        } else {
          this.categ = [];
          for (let item of data['result']) {
            this.categ.push(item);
            this.total_itens = data['total'];
          }
        }

        resolve(true);

      });

    });

  }

  listarLocais() {
    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-locais',
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {
        if (data['result'] == '0') {
          console.log('error get locais');
        } else {
          this.locais = data['result'];
        }

        resolve(true);
        return;

      });

    });

  }

  async emFalta() {
    const alert = await this.alertCtrl.create({
      cssClass: 'descricao',
      header: "Ops!",
      subHeader: 'Este produto est?? em falta ',
      message: 'Estamos nos organizando para repor este produto! Desculpa pelo transtorno.',
      buttons: ['Ok']
    });

    await alert.present();
  }

  async bairros() {
    this.helpers.recebeValorEntrega(10.00);

    const alert = await this.alertCtrl.create({
      header: 'Bairro de Entrega',
      inputs: this.locais,
      buttons: [
        {
          text: 'Ok',
          handler: (data) => {
            if (data) {
              this.configEntrega(data);
              this.mensagemPadrao('Agora sim! Adicione produtos ao carrinho', 2000, 'success');
            }
            else {
              this.helpers.mensagem('Selecione o Bairro/Local corretamente.', 2000, 'warning');
              this.bairros();
            }
          }
        }
      ]
    });

    await alert.present();
  }

  async configEntrega(data) {
    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-local',
        id: data
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(res => {

        if (res['result'] == 0) {
          console.log('erro ao carregar: ', res['result'])
        }
        else {
          this.storage.set('bairro', JSON.stringify(res['result'][0]));
          this.valorEntrega = res['result'][0]['price'];
          this.helpers.recebeValorEntrega(res['result'][0]['price']);
          this.helpers.recebeLocal(res['result'][0]);
          resolve(true);
        }

      });

    });
  }

  async getStorage() {
    await this.storage.init();
    await this.storage.get('bairro').then(data => {
      if (data) {
        var bairro = JSON.parse(data);
        this.helpers.recebeLocal(bairro);
        this.helpers.recebeValorEntrega(bairro.price);
        this.valorEntrega = bairro.price;
      }
    });

    this.storage.get('user').then(data => {

      var user = JSON.parse(data);

      if (data) {
        //usu??rio j?? esteve aqui
        this.userService.setUserCpf(user.celular);
        this.userService.setUserCelular(user.celular);
        this.cpf = user.celular;
        this.userService.setUserNome(user.nome);
        this.nome = user.nome;
        return

      }
    });

  }

  async listarPao(item) {

    const alert = await this.alertCtrl.create({
      cssClass: 'my-custom-class',
      header: 'Selecione o P??o',
      inputs: [
        {
          name: 'pao',
          type: 'radio',
          label: 'P??o com Gergelim',
          value: '(P??o C/ Gergelim)',
          checked: true
        },
        {
          name: 'pao',
          type: 'radio',
          label: 'P??o de Brioche',
          value: '(P??o Brioche)',
        },
        {
          name: 'pao',
          type: 'radio',
          label: 'P??o sem Gergelim',
          value: '(P??o S/ Gergelim)',
        }
      ],
      buttons: [
        {
          text: 'Selecionar',
          handler: (data) => {
            this.helpers.recebePao(data);
            this.paoHamburguer(data, item);
          }
        }
      ]
    });
    await alert.present();
  }

  async paoHamburguer(tipoPao, itemPedido) {
    let pao = itemPedido.nome + '%0A' + tipoPao;
    itemPedido.nome = pao;
    await this.addCarrinho(itemPedido);
    this.helpers.recebePao('');
  }


}