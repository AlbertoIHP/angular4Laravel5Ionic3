import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AutosComponent } from './autos.component';

describe('AutosComponent', () => {
  let component: AutosComponent;
  let fixture: ComponentFixture<AutosComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AutosComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AutosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should be created', () => {
    expect(component).toBeTruthy();
  });
});
