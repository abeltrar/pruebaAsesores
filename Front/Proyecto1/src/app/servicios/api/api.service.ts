import { Injectable } from '@angular/core';
import{loginI} from '../../modelos/login.interface';
import{responseI} from '../../modelos/response.interface';
import{HttpClient,HttpHeaders} from'@angular/common/http';
import{Observable, observable}from'rxjs';
import{listaasesoresI} from "../../modelos/listaasesores.interface";
import{asesorI}from'../../modelos/asesor.interface';


@Injectable({
  providedIn: 'root'
})
export class ApiServicen {

  url:string = "http://localhost/appasesores/"; 

  constructor(private  http:HttpClient) { }

  loginByEmail(form:loginI):Observable<responseI>{
    let direccion = this.url + "auth";

    return this.http.post<responseI>(direccion,form);



  }

  getAllAsesores(page:number):Observable<listaasesoresI[]>{
    
    let direccion= this.url + "asesores?page=" + page;
    return this.http.get<listaasesoresI[]>(direccion);


  }

  getSingleUser(id:any):Observable<asesorI>{
    let direccion = this.url + "asesores?id=" + id;
    return this.http.get<asesorI>(direccion);
  }

  putPatient(form:asesorI):Observable<responseI>{
    let direccion = this.url + "asesores";
    return this.http.put<responseI>(direccion, form);
  }

  deletePatient(from:asesorI):Observable<responseI>{
    let direccion = this.url + "asesores";
    let Options = {
      headers: new HttpHeaders({
         'Conten-type': 'application/json'
      }),
      body:from
    }
    return this.http.delete<responseI>(direccion, Options);
  }

  postUser(form:asesorI):Observable<responseI>{
    let direccion = this.url+ "asesores";
    return this.http.post<responseI>(direccion,form);
  }

  

  


}
