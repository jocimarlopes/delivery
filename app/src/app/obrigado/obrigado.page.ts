import { Component, OnInit } from '@angular/core';
import { Post } from '../services/post.service';
import { UserService } from '../services/user.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-obrigado',
  templateUrl: './obrigado.page.html',
  styleUrls: ['./obrigado.page.scss'],
})
export class ObrigadoPage implements OnInit {

  tempo: any;

  constructor(public provider: Post, public userService: UserService, public router: Router) { }

  ngOnInit() {
  }

  ionViewWillEnter() {
    /* if(this.userService.getUserCelular() == "") {
      this.router.navigate(['/categorias']);
    } */
    this.listarTempo();
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

  goWhats() {
    window.open("https://api.whatsapp.com/send?phone=55"+this.tempo.contato+"&text=CARD%C3%81PIO%20ONLINE%3A%20Pedido%20Realizado%2C%20Cliente%3A%20"+this.userService.getUserNome())+" *Pedido:* ";
  }

}
