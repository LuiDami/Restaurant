var numDni;
var letraDni;



function compruebaIBAN(entrada){
    var salida = false;
    const EXPREG = /^[A-Z]{2}[0-9]{22}$/;
    var iban =""+entrada;
    var pais = iban.slice(0,2); var digPais = iban.slice(2,4)// 4 y 2 diguitos
    var entidad = iban.slice(4,8); /* 4 digitos */ 
    var sucursal= iban.slice(8,12); /* 4 digitos */ 
    var dc = iban.slice(12,14); /* 2 digitos */ 
    var cuenta = iban.slice(14,24); /* 10 digitos */ 
    var auxiliar;
    
    var nSumaD1 = [4 , 8, 5, 10, 9, 7, 3, 6];
    var nSumaD2 = [1, 2, 4, 8, 5, 10, 9, 7, 3, 6];
    const PAIS = 142800;

    var dc1=0; var dc2=0; var dp=0; var strdc=""; var strdp="";
    
    auxiliar = entidad+sucursal;
    for (let i = 0; i < nSumaD1.length; i++) {
        dc1 = dc1 + (nSumaD1[i]*parseInt(auxiliar[i]));  
    }
    for (let i = 0; i < nSumaD2.length; i++) {
        dc2 = dc2 +(nSumaD2[i]*parseInt(cuenta[i]));
    }
    dc1 = 11-(dc1%11); //console.log();
    dc2 =11-(dc2%11); //console.log();
    if (dc1==10) {
        dc1=1;
    } else if (dc1==11){
        dc1=0;
    }
    if (dc2==10) {
        dc2=1;
    } else if (dc2==11){
        dc2=0;
    }
    auxiliar = entidad+sucursal+dc+cuenta+PAIS;
    dp = BigInt(98)-(BigInt(auxiliar)%BigInt(97));
    if (parseInt(dp).toFixed(0).length==1) {
        strdp = "0"+parseInt(dp).toFixed(0);
    }else{
        strdp = parseInt(dp).toFixed(0); 
    }
    
    strdc = dc1.toFixed(0)+dc2.toFixed(0);
    if (dc==strdc&&digPais==strdp&&EXPREG.test(iban)) {
        salida = true;
    }
    return salida;
} //retorna true si IBAN es correcto y false si es incorrecto


function compruebaDNI(palabra=""){

    var validador=false;// si es false no cumple las condiciones

    var lent=false;// maximo 9 caracteres
    var esletra=false;
    var coinci=false;
    var esnum=false;
    var numpal=parseInt(palabra[0]+palabra[1]+palabra[2]+palabra[3]+palabra[4]+palabra[5]+palabra[6]+palabra[7]);//numero en int del dni
    var resto=numpal%23;
    var letras="TRWAGMYFPDXBNJZSQVHLCKE";
    var numeros="0123456789";
    var contador=0;
    /*si tiene el tamaño del dni*/
    if (palabra.length==9) {
        lent=true;
    }
    /*///////////////////////////////////////////////////////////*/
    /*si tiene la letra de letras*/
    for (let index = 0; index < (letras.length); index++) {
        if (palabra[8]==letras[index]) {
            esletra=true;
            index = letras.length;
        }
    }
    /*////////////////////////////////////////////////////////*/
    /*comprueva que los 8 primeros son digitos*/
    for (let i = 0; i < (palabra.length-1); i++) {
        for (let x = 0; x < numeros.length; x++) {
            if (palabra[i]==numeros[x]) {
                contador++
            }
        }  
    }
    if (contador==8) {
        esnum=true;
    }
    /*///////////////////////////////////////////////////////*/


    /*verifica que la letra corresponde al numero*/
    if(palabra[8]==letras[resto]){
        coinci=true;
    }
    /*/////////////////////////////////////////////////////////*/

    /*comprueva que todas los requisitos son validos*/
    if(lent&&esletra&&coinci&&esnum){
        validador= true;
    }
    return validador
} // retorna true si DNI cumple las condiciones


function compruebaNIE(palabra=""){
    console.log("hola mundo")
    var validador=false;// si es false no cumple las condiciones

    var lent=false;// maximo 9 caracteres
    var esletra=false;
    var esletraprincipal=false;
    var coinci=false;
    var esnum=false;
    var numpal=parseInt(palabra[1]+palabra[2]+palabra[3]+palabra[4]+palabra[5]+palabra[6]+palabra[7]);//numero en int del dni
    
    var letras="TRWAGMYFPDXBNJZSQVHLCKE";
    var numeros="0123456789";
    var contador=0;
    var letra=0;
    if (palabra[0]=="Y") {
        letra=10000000;
        esletraprincipal=true;
    }else if(palabra[0]=="Z"){
        letra=20000000;
        esletraprincipal=true;
    }else if(palabra[0]=="X"){
        esletraprincipal=true;
    }
    var resto=(numpal+letra)%23;

    
    /*si tiene el tamaño del dni*/
    if (palabra.length==9) {
        lent=true;
    }
    /*///////////////////////////////////////////////////////////*/
    /*si tiene la letra de letras*/
    for (let index = 0; index < (letras.length); index++) {
        if (palabra[8]==letras[index]) {
            esletra=true;
            index = letras.length;
        }
    }
    /*////////////////////////////////////////////////////////*/
    /*comprueva que los 7 numeros son digitos*/
    for (let i = 1; i < (palabra.length-1); i++) {
        for (let x = 0; x < numeros.length; x++) {
            if (palabra[i]==numeros[x]) {
                contador++
            }
        }  
    }
    if (contador==7) {
        esnum=true;
    }
    /*///////////////////////////////////////////////////////*/


    /*verifica que la letra corresponde al numero*/
    if(palabra[8]==letras[resto]){
        coinci=true;
    }
    /*/////////////////////////////////////////////////////////*/

    /*comprueva que todas los requisitos son validos*/
    if(lent&&esletra&&coinci&&esnum&&esletraprincipal){
        validador= true;
    }
    return validador
} // retorna true si NIE cumple las condiciones