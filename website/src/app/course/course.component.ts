import { Component } from '@angular/core';
import { ApiService } from '../shared/api.service';

@Component({
  selector: 'acb-course',
  templateUrl: './course.component.html',
  styleUrls: ['./course.component.scss']
})
export class CourseComponent {
  public course: any;
  public objectkeys: any = Object.keys;
  constructor(private apiService: ApiService) {
    this.apiService.getCourses().subscribe((response: any) => {
      this.course = response;
    });
   }

}
