import { ToastController, AlertController } from '@ionic/angular';
import { Post } from './../services/post.service';
import { Router } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { NativeStorage } from '@ionic-native/native-storage/ngx';
import { UserService } from '../services/user.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})
export class LoginPage implements OnInit {

  usuario : string = "";
  senha : string = "";
  result : any;

 

  constructor(public userService: UserService, public alertController: AlertController, private storage: NativeStorage, private router:Router, private provider:Post, public toast: ToastController) { }

  ngOnInit() {
  }

  async login(){
    if(this.usuario == ""){
      const toast = await this.toast.create({
        message: 'Preencha o Usuário',
        duration: 2000,
        color: 'warning'
      });
      toast.present();
      return;
    }

    if(this.senha == ""){
      const toast = await this.toast.create({
        message: 'Preencha a Senha',
        duration: 2000,
        color: 'warning'
      });
      toast.present();
      return;
    }


    let dados = {
      requisicao : 'login',
      usuario : this.usuario, 
      senha : this.senha
      
      };

      this.provider.dadosApi(dados, 'apiLogin.php').subscribe(async data => {
      var alert = data['msg'];
      if(data['success']) {
        this.storage.setItem('session_storage', data['result']);
        this.result = data['result'];

        this.userService.setUserCpf(this.result.cpf);
        this.userService.setUserNome(this.result.nome);

          this.router.navigate([ '/categorias']);
                
        const toast = await this.toast.create({
          message: 'Logado com Sucesso!',
          duration: 1000,
          color: 'success'
        });
        toast.present();
        this.usuario = "";
        this.senha = "";
      }else{
        const toast = await this.toast.create({
          message: alert,
          duration: 2000,
          color: 'danger'
        });
        toast.present();
      }
       
               
      });



}



cadastro(){
  this.router.navigate([ '/cadastro']);
}

async recuperarModal(){
  const alert = await this.alertController.create({
    header: 'Recuperar Email!',
    inputs: [
      {
        name: 'email',
        type: 'text',
        placeholder: 'Insira seu Email',
        //value: this.usuario
      },
      
    ],
    buttons: [
      {
        text: 'Cancelar',
        role: 'cancel',
        cssClass: 'secondary',
        handler: () => {
          console.log('Confirm Cancel');
        }
      }, {
        text: 'Enviar',
        handler: (data) => {
         //atualizar pag
         
         this.usuario = data.email;
         this.recuperar();
        }
      }
    ]
  });

  await alert.present();
}

categorias() {
  this.router.navigate(['/categorias']);
}

async mensagemSalvar(msg) {
  const toast = await this.toast.create({
    message: msg,
    duration: 1000
  });
  toast.present();
}



recuperar(){
  return new Promise(resolve => {
        
    let dados = {
      requisicao : 'recuperar',
      usuario : this.usuario,
      };

      this.provider.dadosApi(dados, 'apiLogin.php').subscribe(data => {
        
        
          this.mensagemSalvar(data['result']);
         
        
      });
  });
}


}
