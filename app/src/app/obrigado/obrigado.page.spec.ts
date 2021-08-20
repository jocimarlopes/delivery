import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { IonicModule } from '@ionic/angular';

import { ObrigadoPage } from './obrigado.page';

describe('ObrigadoPage', () => {
  let component: ObrigadoPage;
  let fixture: ComponentFixture<ObrigadoPage>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ObrigadoPage ],
      imports: [IonicModule.forRoot()]
    }).compileComponents();

    fixture = TestBed.createComponent(ObrigadoPage);
    component = fixture.componentInstance;
    fixture.detectChanges();
  }));

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
