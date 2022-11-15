import { Component, OnInit } from '@angular/core';
import { ReactiveFormsModule,FormsModule } from '@angular/forms';
import { FormGroup, FormControl, Validators} from '@angular/forms';
import { asesorI } from 'src/app/modelos/asesor.interface';
import { responseI } from '../../modelos/response.interface';
import { ApiServicen } from '../../servicios/api/api.service';
import { AlertasService } from '../../servicios/alertas/alertas.service';
import { Router, ActivatedRoute } from '@angular/router';


@Component({
  selector: 'app-nuevo',
  templateUrl: './nuevo.component.html',
  styleUrls: ['./nuevo.component.css']
})
export class NuevoComponent implements OnInit {


  datosAsesor?:asesorI;
  nuevoForm = new FormGroup({
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
constructor(private api:ApiServicen, private router:Router, private alert:AlertasService) { }

ngOnInit(): void {
  let token = localStorage.getItem('token');
  this.nuevoForm.patchValue({
    'token' : token
  });
}

postForm(datosAsesor){
    this.api.postUser(datosAsesor).subscribe( data =>{
      let respuesta:responseI = data;
      console.log(data);
      if(respuesta.status == "ok"){
          this.alert.showSuccess('Datos guardados','Hecho');
      }else{
          this.alert.showError(respuesta.result.error_msg,'Error');
      }
    })
}

salir(){
  this.router.navigate(['dashboard']);
}

}
