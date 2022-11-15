import { Component, OnInit } from '@angular/core';
import{ApiServicen}from'../../servicios/api/api.service';
import{Router}from '@angular/router';
import{listaasesoresI}from '../../modelos/listaasesores.interface';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  asesores:listaasesoresI[]|undefined;
  

  constructor(private api:ApiServicen,private router:Router) { }

  ngOnInit(): void {
    this.api.getAllAsesores(1).subscribe(data=>{
      this.asesores = data;
    })
  }

  editarasesor(id:any){
    this.router.navigate(['editar',id]);
  }

  nuevoasesor(){
    this.router.navigate(['nuevo']);
  }



}
