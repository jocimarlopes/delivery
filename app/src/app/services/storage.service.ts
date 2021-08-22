import { Injectable } from '@angular/core';
import { Storage } from '@ionic/storage-angular';
import { HelpersService } from './helpers.service';

@Injectable({
  providedIn: 'root'
})
export class StorageService {
  private _storage: Storage | null = null;

  constructor(
    private storage: Storage,
    public helper: HelpersService,
    ) {
      this.init();
     } 


  /**
   * Iniciar o Storage antes
   * de começar a carregar os dados
   */
   async init() {
    const storage = await this.storage.create();
    this._storage = storage;
  }
  
  /**
   * Setar valores para o Storage
   * Pegar os dados: const name = await storage.get('name');
   */
  async set(key: string, value: any) {
    await this._storage?.set(key, value);
  }

  /**
   * Clear All Data
   * Deletar os dados
   */
  async  clear() {
    await this._storage?.clear();
  }

  /**
   * Pegar valores do Storage
   * await this.storage.get('user');
   */
  get(key: string) {
    return this._storage?.get(key);
  }

}
