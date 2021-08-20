import { Component, OnInit } from '@angular/core';
import { Post } from '../services/post.service';

@Component({
  selector: 'app-horarios',
  templateUrl: './horarios.page.html',
  styleUrls: ['./horarios.page.scss'],
})
export class HorariosPage implements OnInit {

  lista: any = [];

  constructor(
    public provider: Post
  ) { }

  ngOnInit() {
    this.listarTempo();
  }
 
  async listarTempo() {

    return new Promise(resolve => {

      let dados = {
        requisicao: 'listar-horarios',
      };
      this.provider.dadosApi(dados, 'apiHorarios.php').subscribe(data => {
        if (data['result'] == '0') {
        } else {
          this.lista = [];
          for (let item of data['result']) {
            this.lista.push(item);
          }
        }
        resolve(true);
      });
    });
     
  }


}
