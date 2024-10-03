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

  constructor(){
    console.log(localStorage.getItem('idInstance'))
    if(localStorage.getItem('idInstance') === null || localStorage.getItem('idInstance') === undefined ){
      localStorage.setItem('idInstance', uuidv4());
      this.idInstance = localStorage.getItem('idInstance') || "";
    }else{
      this.idInstance = localStorage.getItem('idInstance') || "";
    }
  }

}
