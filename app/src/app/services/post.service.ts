import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import 'rxjs/add/operator/map';


@Injectable()
export class Post {

    //url: string = 'https://jocimarlopes.tech/apis/cardapio/';
    //url: string = 'https://lanchesdojo.store/';
    url: string = 'https://kingsbeer.store/';

    server: string = this.url + 'api/';
    url_site_img_produtos: string = this.url + 'admin/storage/';
    url_site_img_cat: string = this.url + 'admin/storage/';

    constructor(private http: HttpClient) {
    }

    dadosApi(dados: any, api: string) {
        const httpOptions = {
            headers: new HttpHeaders({ 'Content-Type': 'application/json' })
        }
        let url = this.server + api;
        return this.http.post(url, JSON.stringify(dados), httpOptions).map(res => res);
    }
}
