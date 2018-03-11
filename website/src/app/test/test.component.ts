import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ApiService } from '../shared/api.service';

@Component({
  selector: 'acb-test',
  templateUrl: './test.component.html',
  styleUrls: ['./test.component.scss']
})
export class TestComponent {

  public lessonName: string;
  constructor(private modalService: NgbModal, private apiService: ApiService) {}

  public open(content: any) {
    this.modalService.open(content).result.then((result: any) => {
      if (result === 'Save') {
        this.apiService.createLesson(this.lessonName).subscribe((res: any) => {
          console.log(res);
        });
      }
    }, (reason) => {});
  }

  public submit(event: any) {
    event.preventDefault();
    event.stopPropagation();
  }

}
