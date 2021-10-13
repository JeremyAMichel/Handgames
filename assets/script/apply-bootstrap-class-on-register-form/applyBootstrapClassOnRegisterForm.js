let registerEmailInput = document.querySelector('#registration_form_email');
let registerPasswordInput = document.querySelector('#registration_form_plainPassword');
let registerPseudoInput = document.querySelector('#registration_form_pseudo');
let registerAgreeTerms = document.querySelector('#registration_form_agreeTerms');
let registerAgreeTermsDiv = document.querySelector("form[name='registration_form'] div:nth-child(4)");


registerEmailInput.classList.add('form-control');
registerPasswordInput.classList.add('form-control');
registerPseudoInput.classList.add('form-control');
registerAgreeTerms.classList.add('form-check-input');
registerAgreeTerms.classList.add('ms-2');
registerAgreeTermsDiv.classList.add('mb-2');