import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { FormsModule } from '@angular/forms';

@NgModule({
  imports: [
    CommonModule,
    HttpClientModule,
    NgbModule.forRoot(),
    FormsModule
  ],
  exports: [
    HttpClientModule,
    FormsModule,
    NgbModule
  ],
  declarations: []
})
export class CoreModule { }
