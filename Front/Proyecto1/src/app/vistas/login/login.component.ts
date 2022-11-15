import { Component, OnInit } from '@angular/core';
import {FormGroup,FormControl,Validators} from '@angular/forms';
import {ApiServicen} from '../../servicios/api/api.service';
import{loginI}from '../../modelos/login.interface';
import {Router} from '@angular/router';
import {responseI}from '../../modelos/response.interface';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  loginForm = new FormGroup({

    usuario: new FormControl('',Validators.required),
    password: new FormControl('',Validators.required)

  })

  constructor(private api:ApiServicen, private router:Router) { }

   errorStatus:boolean = false;
   errorMsj:any = "";


  ngOnInit(): void {
    this.checkLocalStorage();
  }


  checkLocalStorage(){
    if(localStorage.getItem('token')){
      this.router.navigate(['dashboard'])
    }
  }



  onLogin(form:loginI){
   this.api.loginByEmail(form).subscribe(data=>{
    let dataResponse:responseI = data;
    if(dataResponse.status=="ok"){
      localStorage.setItem("token",dataResponse.result.token);
      this.router.navigate(['dashboard']);
    }else{
      this.errorStatus=true;
      this.errorMsj = dataResponse.result.error_msg;
    }
   });


  }

}
