import { Component, OnInit } from '@angular/core';

import { AlertController, Platform } from '@ionic/angular';
import { SplashScreen } from '@ionic-native/splash-screen/ngx';
import { StatusBar } from '@ionic-native/status-bar/ngx';
import { Post } from './services/post.service';

@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss']
})
export class AppComponent implements OnInit {
  public selectedIndex = 0;
  public appPages = [

    /* {
      title: 'Categorias',
      url: '/categorias',
      icon: 'fast-food'
    }, */

    {
      title: 'Produtos',
      url: '/produtos',
      icon: 'fast-food'
    },
    
    {
      title: 'Horários de Atendimento',
      url: '/horarios',
      icon: 'time'
    },
   
  ];
  

  constructor(
    private platform: Platform,
    private splashScreen: SplashScreen,
    private statusBar: StatusBar,
    public provider: Post,
    public alertCtrl: AlertController
  ) {
    this.initializeApp();
  }

  initializeApp() {
    this.platform.ready().then(() => {
      this.statusBar.styleDefault();
      this.splashScreen.hide();
    });
  }

  ngOnInit() {
    
  }

  async participe() {
    const alert = await this.alertCtrl.create({
      cssClass: 'descricao',
      header: "Quer o seu Sistema Delivery?",
      subHeader: 'Entre em contato e automatize o seu Negócio Delivery também!',
      message: '<a target="_blank" href="https://jocimarlopes.tech">Acessar o site</a><br><br>Sistema desenvolvido por Jocimar Lopes',
      buttons: ['Sair']
    });

    await alert.present();
  }

}
