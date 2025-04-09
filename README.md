# Informace o projektu #
Tento cvičný projekt slouží jako nástroj k naučení se a získání zkušeností s PHP frameworkem Symfony. Nejdříve jsem vytvořil HTML kostru navrhované webové aplikace zabývající se evidencí zaměstnanců. Dále byla tato HTML stránka graficky upravena pomocí CSS. 
V dalších krocích se začala využívat MVC architektura -- vyvíjel se controller, view byl upraven pomocí Twig nástroje, model byl tvořen SQLite databází, která byla dále namodelovaná díky Doctrine ORM.

Aplikace je tvořena titulní stranou, ze které lze přes vyhledávací okno dohledat jakéhokoli evidovaného zaměstnance. Z vyhledaných zaměstnanců lze pak přejít na detail zaměstance, upravit ho nebo se podívat na jeho evidované účty. U každého zaměstnance je vidět jejich
fotka, kontakt a nastavené funkce. Zaměstnance lze upravit přes formulář a změnit mu popisek, jméno, email, kancelář, popisek, telefon nebo pomocí scroll-down multichoice mu vybrat různé role (funkce). Každý zaměstnanec může mít více účtů, do kterých se dostaneme skrze
tlačítko u zaměstnance. Účty lze přidávat, upravovat nebo mazat. Jakákoli manipulace se zaměstnancem, rolí nebo účtem je vyřešena pomocí formulářů a pomoci Doctrine ORM je implementována i základní validace vyplňovaných údajů.

Ve složce __src__ lze najít implementaci jednotlivých kontrolerů, entit (reflektujících ty databázové, společně se vzájemnými vazbami), formulářů a pomocných operací.

Ve složce __templates__ se nachází Twig soubory implementující šablonovanou HTML část aplikace. Dále ve složce __public/styles__ naleznete CSS soubory.
