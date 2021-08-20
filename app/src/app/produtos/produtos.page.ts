import { Post } from './../services/post.service';
import { Component, OnInit } from '@angular/core';
import { ToastController, AlertController, ModalController } from '@ionic/angular';
import { Router, ActivatedRoute } from '@angular/router';
import { NativeStorage } from '@ionic-native/native-storage/ngx';
import { UserService } from '../services/user.service';
import * as moment from 'moment';
import { HelpersService } from '../services/helpers.service';
import { HorariosService } from '../services/horarios.service';

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

  valorEntrega: any = 10.00;

  entrega: any = [];

  constructor(
    public helpers: HelpersService, 
    public modalController: ModalController, 
    public alertCtrl: AlertController, 
    public userService: UserService, 
    private storage: NativeStorage, 
    private actRouter: ActivatedRoute, 
    private router: Router, 
    private provider: Post, 
    public toast: ToastController,
    public horarios: HorariosService
    
    ) {

    this.listarTempo();
  }

  async delay(ms: number) {
    return new Promise( resolve => setTimeout(resolve, ms) );
  }

  ngOnInit() {
    this.horarios.pegarHoraAtual();
    
    this.listarLocais();
    this.actRouter.params.subscribe((data: any) => {
      this.id = data.id;
    });
    this.listarCategorias();

  }

  ionViewWillEnter() {
    this.cpf = this.userService.getUserCpf();

    this.lista = [];
    this.start = 0;
    this.listarCarrinho();
    this.url_site_img = this.provider.url_site_img_produtos;
  }

  comecar() {
    if (this.statusTempo == 0) {
      this.status();
    }
    else {
      if(this.horarios.pegarHoraAtual() < this.horarios.pegarHoraAbertura() && this.horarios.pegarHoraAtual() > 12) {

        this.status();
      }
      else {
        if(this.horarios.pegarHoraAtual() > this.horarios.pegarHoraFechamento() && this.horarios.pegarHoraAtual() < 12) {
          this.status();
        }
        if(this.horarios.pegarHoraAtual() > this.horarios.pegarHoraFechamento() && this.horarios.pegarHoraFechamento() > 12) {
          this.status();
        }
        else {
          if(this.horarios.pegarHoraAtual() == this.horarios.pegarHoraAbertura() && this.horarios.pegarMinutoAtual() < this.horarios.pegarMinutoAbertura()) {
            this.status();
          }
          else {
            if(this.horarios.pegarHoraAtual() == this.horarios.pegarHoraFechamento() &&  this.horarios.pegarMinutoAtual() >= this.horarios.pegarMinutoFechamento()) {
              this.status();
            }
            else {
              if (this.cpf != '') {
                this.router.navigate(['/carrinho']);
              }
              if (this.cpf === undefined || this.cpf === '') {
                this.nomeCpf();
              }
            }
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

  async listarTempo() {

    var date = await new Date();
    var id = await date.getDay();

    if(this.horarios.pegarHoraAtual() >= 0 && this.horarios.pegarHoraAtual() < 6) {
      var id = id -1;
    }

    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-horario',
        id_dia: id
      };
      this.provider.dadosApi(dados, 'apiHorarios.php').subscribe(data => {
        this.horarios.setDia(data['result'][0]);
        this.statusTempo = data['result'][0]['status'];
        this.comecar();
      });
    });
    

  }



  categorias() {
    this.router.navigate(['/categorias']);
  }


  //barra de rolagem
  loadData(event) {

    this.start += this.limit;

    setTimeout(() => {
      this.listarProdutos().then(() => {
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
      message: 'Faça Login ou Cadastre-se.',
      duration: 3000,
      color: 'dark'
    });
    toast.present();
  }

  async nomeCpf() {
    /* this.router.navigate(['/login']); */

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
          text: 'Próximo',
          handler: (data) => {
            if (data.nome != "" || data.celular != "") {
              if (data.celular.length == 9 || data.celular.length == 11 || data.celular.length == 12) {
                this.userService.setUserCpf(data.celular);
                this.userService.setUserCelular(data.celular);
                this.cpf = data.celular;
                this.userService.setUserNome(data.nome);
                this.nome = data.nome;
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


  addCarrinho(id) {

    if (this.statusTempo == 1) {

      return new Promise(resolve => {

        let dados = {
          requisicao: 'add-carrinho',
          id_produto: id,
          cpf: this.cpf,

        };

        this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(data => {

          this.mensagemSalvar();
          this.listarCarrinho();

        });
      });

    } else {

      this.status();

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
      /* subHeader: 'É uma delícia, viu? ', */
      message: '<b>Descrição: </b><br>' + this.newDescricao + '<br><br>' + '<img class="descricao-img" src="' + this.url_site_img + produto.image + '">',
      buttons: ['Fechar']
    });

    await alert.present();
  }

  async status() {


    const alert = await this.alertCtrl.create({
      cssClass: 'descricao',
      header: "Boa noite!",
      subHeader: 'Estamos fechados',
      message: 'Infelizmente não estamos atendendo agora! Obrigado',
      buttons: ['Ok, obrigado']
    });

    await alert.present();
  }

  segmentChanged(ev: any) {
    this.delay(500);

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
          this.ionViewWillEnter();
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
        this.locais = data['result'];
        
        if (data['result'] == '0') {
          this.ionViewWillEnter();
        } else {
          for (let item of data['result']) {
            //this.locais = item;
            
          }
        }

        resolve(true);

      });

    });

  }

  async emFalta() {
    const alert = await this.alertCtrl.create({
      cssClass: 'descricao',
      header: "Ops!",
      subHeader: 'Este produto está em falta ',
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
            this.configEntrega(data);
            this.mensagemPadrao('Agora sim! Adicione produtos ao carrinho', 2000, 'success');
          }
        }
      ]
    });

    await alert.present();
  }

  configEntrega(data) {
    
    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-local',
        id: data
      };

      this.provider.dadosApi(dados, 'apiProdutos.php').subscribe(res => {
        
        this.valorEntrega = res['result'][0]['price'];
        this.helpers.recebeValorEntrega(res['result'][0]['price']);
        this.helpers.recebeLocal(res['result'][0]);
        resolve(true);

      });

    });
  }

}