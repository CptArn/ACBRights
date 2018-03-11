import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable()
export class ApiService {

  constructor(private http: HttpClient) {}

  public getCourses(): any {
    return this.http.get('http://acb/api/api.php?action=fullcourse&course_id=1');
  }

  public createLesson(name: string): any {
    return this.http.post('http://acb/api/api.php?action=lesson', {'name': name}, {});
  }

  public createCourse(name: string): any {
    return this.http.post('http://acb/api/api.php?action=course', {'name': name}, {});
  }

  public createCourseDivision(name: string): any {
    return this.http.post('http://acb/api/api.php?action=courseDivision', {'name': name}, {});
  }

}
