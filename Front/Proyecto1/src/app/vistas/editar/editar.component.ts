import { Component, OnInit } from '@angular/core';
import{Router,ActivatedRoute}from '@angular/router';
import{asesorI}from'../../modelos/asesor.interface';
import{ApiServicen}from '../../servicios/api/api.service'
import { ReactiveFormsModule,FormsModule } from '@angular/forms';
import { FormGroup, FormControl, Validators} from '@angular/forms';
import { responseI } from 'src/app/modelos/response.interface';
import{AlertasService}from'../../servicios/alertas/alertas.service';

@Component({
  selector: 'app-editar',
  templateUrl: './editar.component.html',
  styleUrls: ['./editar.component.css']
})
export class EditarComponent implements OnInit {

  constructor(private activerouter:ActivatedRoute,private router:Router,private api:ApiServicen,private alertas:AlertasService) { }

  datosAsesor?:asesorI;
  editarForm = new FormGroup({
     IdAsesor: new FormControl(''),
     nombre: new FormControl(''),
     cedula: new FormControl(''),
     telefono: new FormControl(''),
     fechanacimiento: new FormControl(''),
     genero: new FormControl(''),
     clientetrabajo: new FormControl(''),
     sede: new FormControl(''),
     userregistro: new FormControl(''),
     edad: new FormControl(''),
     token: new FormControl(''),
     
});


  ngOnInit(): void {
     let AsesorId = this.activerouter.snapshot.paramMap.get('id');
     let token = this.getToken();
     this.api.getSingleUser(AsesorId).subscribe(data  =>{
          this.datosAsesor = data[0];
          this.editarForm.setValue({
          
            "IdAsesor": AsesorId,
            "nombre": this.datosAsesor.nombre,
            "cedula": this.datosAsesor.cedula,
            "telefono": this.datosAsesor.telefono,
            "fechanacimiento": this.datosAsesor.fechanacimiento,
            "genero": this.datosAsesor.genero,
            "clientetrabajo": this.datosAsesor.clientetrabajo,
            "sede": this.datosAsesor.sede,
            "userregistro": this.datosAsesor.userregistro,
            "edad": this.datosAsesor.edad,
            "token": token,
            


          });
          console.log(this.editarForm.value)
     })
  }


  getToken(){
    return localStorage.getItem('token');
  }



  postForm(datosAsesor){
    this.api.putPatient(datosAsesor).subscribe( data =>{
        let respuesta:responseI = data;
        console.log(data);
        if(respuesta.status == "ok"){
            this.alertas.showSuccess('Datos modificados','Hecho');
        }else{
            this.alertas.showError(respuesta.result.error_msg,'Error');
        }
    })
  }

  eliminar(){
   let datos:any = this.editarForm.value;
    this.api.deletePatient(datos).subscribe(data =>{
      let respuesta:responseI = data;
        if(respuesta.status == "ok"){
            this.alertas.showSuccess('Paciente eliminado','Hecho');
            this.router.navigate(['dashboard']);
        }else{
            this.alertas.showError(respuesta.result.error_msg,'Error');
        }
    })

    
  
  }

  salir(){
    this.router.navigate(['dashboard']);
  }


  
}
