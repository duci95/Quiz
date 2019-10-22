const reFirstLast = /^([A-ZŠĐČĆŽ][a-zšđčćž\-']{2,20})(\s[A-ZŠĐČĆŽ][a-zšđčćž\-']{2,20})*$/;

const rePassword =  /^[A-ZŠĐČĆŽa-zšđčćž?!&^#$%@*0-9]{8,15}$/;

const reEmail = /^[^@\s]{3,25}@[^@\s]{2,10}\.[^@\s]{2,7}$/;

const firstnameWarning = "Ime ne može imati manje od 2 i više od 20 karaktera";
const lastnameWarninig  = "Prezime ne može imati manje od 2 i više od 20 karaktera";
const emailWarning = "Email nije u dobrom formatu";
const passwordWarning = "Lozinka ne može imati manje od 8 i više od 15 karaktera";
const matchingPasswordsWarning = "Lozinke se ne podudaraju";
const permittedExtensions = ["gif", "png", "jpg"];

const activeWarning = "Aktivnost nije odabrana";
const blockedWarning = "Blokiranst nije odabrana";
const roleWarning = "Uloga nije odabrana";
