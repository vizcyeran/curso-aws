import { HttpClient } from '@angular/common/http';
import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { v4 as uuidv4 } from 'uuid';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet],
  templateUrl: './app.component.html',
  styleUrl: './app.component.css'
})
export class AppComponent {
  title = 'curso-aws';

  public idInstance:string = "";

  constructor(private http: HttpClient){
    

    this.http.get('/instance.php').subscribe((data: any)=> {
       this.idInstance = data.instance_id;
    })

  }

}
