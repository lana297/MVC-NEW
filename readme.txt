1. konvencije nazivanja
 	- naziv filea mora biti ist kao i naziv klase
	-koristi se camelcase
	- tip klase mora biti u imenu klase (apstract interface, itd, npr apstract controller)



2. routing
	-asocijativan array kojem je key  relativna putanja od roota a value je ime controllera, odnosno ime controllera::imemetodecontrolleru (primjer User::index ili News)                   
)
	-ako ima vise od 3 parametra -> post!

		npr $routes = array(
				'korisnik'=> 'User',// /korisnik
				'korisnik/Lista' => 'User::ShowList',// /korisnik/lista
);
	// korisnik/lista

3- controlleri i modeli
	-zive u namespaceu controller/model
	-moraju extendati abstraktni controller/model

	
	C:\xampp\php