var contactsService;

function doCheck(){
	scope = 'http://www.google.com/m8/feeds';
	var token = google.accounts.user.checkLogin(scope);
	if (token != ''){
		document.getElementById("boton_enviar").disabled = false;
		getMyContacts();
	}else{
		document.getElementById("boton_permitir").disabled = false;
		enlace.onclick=function(){
			var scope2 = 'http://www.google.com/m8/feeds';
			var token = google.accounts.user.login(scope2);
		}
	}
}


function setupContactsService() {
  contactsService = new google.gdata.contacts.ContactsService('exampleCo-exampleApp-1.0');
}

function logMeIn() {
  var scope = 'http://www.google.com/m8/feeds';
  var token = google.accounts.user.login(scope);
}

function initFunc() {
  setupContactsService();
  doCheck();
//  logMeIn();
//  getMyContacts();
}

function getMyContacts() {
  var contactsFeedUri = 'http://www.google.com/m8/feeds/contacts/default/full';
  var query = new google.gdata.contacts.ContactQuery(contactsFeedUri);
  query.setMaxResults(1000);
  contactsService.getContactFeed(query, handleContactsFeed, handleError);
}

var handleContactsFeed = function(result) {
	var entries = result.feed.entry;
	var formulario = document.getElementById("gmail");
	for (var i = 0; i < entries.length; i++) {
	    	var contactEntry = entries[i];
	    	var emailAddresses = contactEntry.getEmailAddresses();
		for (var j = 0; j < emailAddresses.length; j++) {
      			var emailAddress = emailAddresses[j].getAddress();
			var lista = document.createElement("input");
			var texto = document.createTextNode(emailAddress);
			var salto = document.createElement("br");
			lista.name=emailAddress;
			lista.value=emailAddress;
			lista.type="checkbox";
			lista.checked="true";
			formulario.appendChild(salto);
			formulario.appendChild(texto);
			formulario.appendChild(lista);
		}
	}
}


function logMeOut() {
  google.accounts.user.logout();
}

function handleError(e) {
  alert("There was an error!");
  alert(e.cause ? e.cause.statusText : e.message);
}

