import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CourseComponent } from './course/course.component';
import { TestComponent } from './test/test.component';

const routes: Routes = [
  {path: 'test', component: TestComponent},
  {path: 'course', component: CourseComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
