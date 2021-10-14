<?php

$dati_generali = array(
    array("DatiAnagrafici/IdFiscaleIVA/IdCodice","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/IdFiscaleIVA/IdCodice"),
    array("DatiAnagrafici/CodiceFiscale","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/CodiceFiscale"),
    array("DatiAnagrafici/Anagrafica/Denominazione","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/Anagrafica/Denominazione"),
    array("DatiAnagrafici/IdFiscaleIVA/IdCodice","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/IdFiscaleIVA/IdCodice"),
    array("DatiAnagrafici/CodiceFiscale","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/CodiceFiscale"),
    array("DatiAnagrafici/Anagrafica/Denominazione","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/Anagrafica/Denominazione"),
    array("DatiAnagrafici/Anagrafica/Cognome","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/Anagrafica/Cognome"),
    array("DatiAnagrafici/Anagrafica/Nome","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/Anagrafica/Nome"),    
    array("DatiGeneraliDocumento/TipoDocumento","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/TipoDocumento"),
    array("DatiGeneraliDocumento/Divisa","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/Divisa"),
    array("DatiGeneraliDocumento/Data","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/Data"),
    array("DatiGeneraliDocumento/Numero","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/Numero"),
    array("DatiGeneraliDocumento/ImportoTotaleDocumento","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/ImportoTotaleDocumento"),
);

$scadenze = array(
    array("ModalitaPagamento","FatturaElettronicaBody/DatiPagamento/DettaglioPagamento/","DettaglioPagamento/ModalitaPagamento"),
    array("DataScadenzaPagamento","FatturaElettronicaBody/DatiPagamento/DettaglioPagamento/","DettaglioPagamento/DataScadenzaPagamento"),
    array("ImportoPagamento","FatturaElettronicaBody/DatiPagamento/DettaglioPagamento/","DettaglioPagamento/ImportoPagamento"),
    array("IBAN","FatturaElettronicaBody/DatiPagamento/DettaglioPagamento/","DettaglioPagamento/IBAN"),
);

$ritenute = array(
    array("TipoRitenuta","FatturaElettronicaBody/DatiGenerali/DatiGeneraliDocumento/DatiRitenuta","TipoRitenuta"),
    array("ImportoRitenuta","FatturaElettronicaBody/DatiGenerali/DatiGeneraliDocumento/DatiRitenuta","ImportoRitenuta"),
    array("AliquotaRitenuta","FatturaElettronicaBody/DatiGenerali/DatiGeneraliDocumento/DatiRitenuta","AliquotaRitenuta"),
    array("CausalePagamento","FatturaElettronicaBody/DatiGenerali/DatiGeneraliDocumento/DatiRitenuta","CausalePagamento"),
);

$beniservizi = array(
    array("NumeroLinea","FatturaElettronicaBody/DatiBeniServizi/DettaglioLinee","NumeroLinea"),
    array("Descrizione","FatturaElettronicaBody/DatiBeniServizi/DettaglioLinee","Descrizione"),
    array("Quantita","FatturaElettronicaBody/DatiBeniServizi/DettaglioLinee","Quantita"),
    array("UnitaMisura","FatturaElettronicaBody/DatiBeniServizi/DettaglioLinee","UnitaMisura"),
    array("PrezzoUnitario","FatturaElettronicaBody/DatiBeniServizi/DettaglioLinee","PrezzoUnitario"),
    array("PrezzoTotale","FatturaElettronicaBody/DatiBeniServizi/DettaglioLinee","PrezzoTotale")
);

$ddt = array(
    array("NumeroDDT","FatturaElettronicaBody/DatiGenerali/DatiDDT","NumeroDDT"),
    array("DataDDT","FatturaElettronicaBody/DatiGenerali/DatiDDT","DataDDT"),
    array("RiferimentoNumeroLinea","FatturaElettronicaBody/DatiGenerali/DatiDDT","RiferimentoNumeroLinea")
);

// $header_1_1 = array (
//     array("IdTrasmittente/IdPaese","FatturaElettronicaHeader/DatiTrasmissione/","IdTrasmittente/IdPaese"),
//     array("IdTrasmittente/IdCodice","FatturaElettronicaHeader/DatiTrasmissione/","IdTrasmittente/IdCodice"),
//     array("ProgressivoInvio","FatturaElettronicaHeader/DatiTrasmissione/","ProgressivoInvio"),
//     array("FormatoTrasmissione","FatturaElettronicaHeader/DatiTrasmissione/","FormatoTrasmissione"),
//     array("CodiceDestinatario","FatturaElettronicaHeader/DatiTrasmissione/","CodiceDestinatario"),
//     array("ContattiTrasmittente/Telefono","FatturaElettronicaHeader/DatiTrasmissione/","ContattiTrasmittente/Telefono"),
//     array("ContattiTrasmittente/Email","FatturaElettronicaHeader/DatiTrasmissione/","ContattiTrasmittente/Email"),
//     array("PECDestinatario","FatturaElettronicaHeader/DatiTrasmissione/","PECDestinatario")
// );

// $header_1_2 = array (
//     array("DatiAnagrafici/IdFiscaleIVA/IdPaese","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/IdFiscaleIVA/IdPaese"),
//     array("DatiAnagrafici/IdFiscaleIVA/IdCodice","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/IdFiscaleIVA/IdCodice"),
//     array("DatiAnagrafici/CodiceFiscale","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/CodiceFiscale"),
//     array("DatiAnagrafici/Anagrafica/Denominazione","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/Anagrafica/Denominazione"),
//     array("DatiAnagrafici/Anagrafica/Nome","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/Anagrafica/Nome"),
//     array("DatiAnagrafici/Anagrafica/Cognome","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/Anagrafica/Cognome"),
//     array("DatiAnagrafici/Anagrafica/Titolo","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/Anagrafica/Titolo"),
//     array("DatiAnagrafici/Anagrafica/CodEORI","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/Anagrafica/CodEORI"),
//     array("DatiAnagrafici/AlboProfessionale","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/AlboProfessionale"),
//     array("DatiAnagrafici/ProvinciaAlbo","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/ProvinciaAlbo"),
//     array("DatiAnagrafici/NumeroIscrizioneAlbo","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/NumeroIscrizioneAlbo"),
//     array("DatiAnagrafici/DataIscrizioneAlbo","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/DataIscrizioneAlbo"),
//     array("DatiAnagrafici/RegimeFiscale","FatturaElettronicaHeader/CedentePrestatore/","DatiAnagrafici/RegimeFiscale"),
//     array("Sede/Indirizzo","FatturaElettronicaHeader/CedentePrestatore/","Sede/Indirizzo"),
//     array("Sede/NumeroCivico","FatturaElettronicaHeader/CedentePrestatore/","Sede/NumeroCivico"),
//     array("Sede/CAP","FatturaElettronicaHeader/CedentePrestatore/","Sede/CAP"),
//     array("Sede/Comune","FatturaElettronicaHeader/CedentePrestatore/","Sede/Comune"),
//     array("Sede/Provincia","FatturaElettronicaHeader/CedentePrestatore/","Sede/Provincia"),
//     array("Sede/Nazione","FatturaElettronicaHeader/CedentePrestatore/","Sede/Nazione"),
//     array("StabileOrganizzazione/Indirizzo","FatturaElettronicaHeader/CedentePrestatore/","StabileOrganizzazione/Indirizzo"),
//     array("StabileOrganizzazione/NumeroCivico","FatturaElettronicaHeader/CedentePrestatore/","StabileOrganizzazione/NumeroCivico"),
//     array("StabileOrganizzazione/CAP","FatturaElettronicaHeader/CedentePrestatore/","StabileOrganizzazione/CAP"),
//     array("StabileOrganizzazione/Comune","FatturaElettronicaHeader/CedentePrestatore/","StabileOrganizzazione/Comune"),
//     array("StabileOrganizzazione/Provincia","FatturaElettronicaHeader/CedentePrestatore/","StabileOrganizzazione/Provincia"),
//     array("StabileOrganizzazione/Nazione","FatturaElettronicaHeader/CedentePrestatore/","StabileOrganizzazione/Nazione"),
//     array("IscrizioneREA/Ufficio","FatturaElettronicaHeader/CedentePrestatore/","IscrizioneREA/Ufficio"),
//     array("IscrizioneREA/NumeroREA","FatturaElettronicaHeader/CedentePrestatore/","IscrizioneREA/NumeroREA"),
//     array("IscrizioneREA/CapitaleSociale","FatturaElettronicaHeader/CedentePrestatore/","IscrizioneREA/CapitaleSociale"),
//     array("IscrizioneREA/SocioUnico","FatturaElettronicaHeader/CedentePrestatore/","IscrizioneREA/SocioUnico"),
//     array("IscrizioneREA/StatoLiquidazione","FatturaElettronicaHeader/CedentePrestatore/","IscrizioneREA/StatoLiquidazione"),
//     array("Contatti/Telefono","FatturaElettronicaHeader/CedentePrestatore/","Contatti/Telefono"),
//     array("Contatti/Fax","FatturaElettronicaHeader/CedentePrestatore/","Contatti/Fax"),
//     array("Contatti/Email","FatturaElettronicaHeader/CedentePrestatore/","Contatti/Email"),
//     array("RiferimentoAmministrazione","FatturaElettronicaHeader/CedentePrestatore/","RiferimentoAmministrazione")
// );

// $header_1_3 = array (
//     array("DatiAnagrafici/IdFiscaleIVA/IdPaese","FatturaElettronicaHeader/RappresentanteFiscale/","DatiAnagrafici/IdFiscaleIVA/IdPaese"),
//     array("DatiAnagrafici/IdFiscaleIVA/IdCodice","FatturaElettronicaHeader/RappresentanteFiscale/","DatiAnagrafici/IdFiscaleIVA/IdCodice"),
//     array("DatiAnagrafici/CodiceFiscale","FatturaElettronicaHeader/RappresentanteFiscale/","DatiAnagrafici/CodiceFiscale"),
//     array("DatiAnagrafici/Anagrafica/Denominazione","FatturaElettronicaHeader/RappresentanteFiscale/","DatiAnagrafici/Anagrafica/Denominazione"),
//     array("DatiAnagrafici/Anagrafica/Nome","FatturaElettronicaHeader/RappresentanteFiscale/","DatiAnagrafici/Anagrafica/Nome"),
//     array("DatiAnagrafici/Anagrafica/Cognome","FatturaElettronicaHeader/RappresentanteFiscale/","DatiAnagrafici/Anagrafica/Cognome"),
//     array("DatiAnagrafici/Anagrafica/Titolo","FatturaElettronicaHeader/RappresentanteFiscale/","DatiAnagrafici/Anagrafica/Titolo"),
//     array("DatiAnagrafici/Anagrafica/CodEORI","FatturaElettronicaHeader/RappresentanteFiscale/","DatiAnagrafici/Anagrafica/CodEORI")
// );

// $header_1_4 = array(
//     array("DatiAnagrafici/IdFiscaleIVA/IdPaese","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/IdFiscaleIVA/IdPaese"),
//     array("DatiAnagrafici/IdFiscaleIVA/IdCodice","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/IdFiscaleIVA/IdCodice"),
//     array("DatiAnagrafici/CodiceFiscale","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/CodiceFiscale"),
//     array("DatiAnagrafici/Anagrafica/Denominazione","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/Anagrafica/Denominazione"),
//     array("DatiAnagrafici/Anagrafica/Nome","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/Anagrafica/Nome"),
//     array("DatiAnagrafici/Anagrafica/Cognome","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/Anagrafica/Cognome"),
//     array("DatiAnagrafici/Anagrafica/Titolo","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/Anagrafica/Titolo"),
//     array("DatiAnagrafici/Anagrafica/CodEORI","FatturaElettronicaHeader/CessionarioCommittente/","DatiAnagrafici/Anagrafica/CodEORI"),
//     array("Sede/Indirizzo","FatturaElettronicaHeader/CessionarioCommittente/","Sede/Indirizzo"),
//     array("Sede/NumeroCivico","FatturaElettronicaHeader/CessionarioCommittente/","Sede/NumeroCivico"),
//     array("Sede/CAP","FatturaElettronicaHeader/CessionarioCommittente/","Sede/CAP"),
//     array("Sede/Comune","FatturaElettronicaHeader/CessionarioCommittente/","Sede/Comune"),
//     array("Sede/Provincia","FatturaElettronicaHeader/CessionarioCommittente/","Sede/Provincia"),
//     array("Sede/Nazione","FatturaElettronicaHeader/CessionarioCommittente/","Sede/Nazione"),
//     array("StabileOrganizzazione/Indirizzo","FatturaElettronicaHeader/CessionarioCommittente/","StabileOrganizzazione/Indirizzo"),
//     array("StabileOrganizzazione/NumeroCivico","FatturaElettronicaHeader/CessionarioCommittente/","StabileOrganizzazione/NumeroCivico"),
//     array("StabileOrganizzazione/CAP","FatturaElettronicaHeader/CessionarioCommittente/","StabileOrganizzazione/CAP"),
//     array("StabileOrganizzazione/Comune","FatturaElettronicaHeader/CessionarioCommittente/","StabileOrganizzazione/Comune"),
//     array("StabileOrganizzazione/Provincia","FatturaElettronicaHeader/CessionarioCommittente/","StabileOrganizzazione/Provincia"),
//     array("StabileOrganizzazione/Nazione","FatturaElettronicaHeader/CessionarioCommittente/","StabileOrganizzazione/Nazione"),
//     array("RappresentanteFiscale/IdFiscaleIVA/IdPaese","FatturaElettronicaHeader/CessionarioCommittente/","RappresentanteFiscale/IdFiscaleIVA/IdPaese"),
//     array("RappresentanteFiscale/IdFiscaleIVA/IdCodice","FatturaElettronicaHeader/CessionarioCommittente/","RappresentanteFiscale/IdFiscaleIVA/IdCodice"),
//     array("RappresentanteFiscale/Denominazione","FatturaElettronicaHeader/CessionarioCommittente/","RappresentanteFiscale/Denominazione"),
//     array("RappresentanteFiscale/Nome","FatturaElettronicaHeader/CessionarioCommittente/","RappresentanteFiscale/Nome"),
//     array("RappresentanteFiscale/Cognome","FatturaElettronicaHeader/CessionarioCommittente/","RappresentanteFiscale/Cognome")
// );

// $header_1_5 = array(
//     array("DatiAnagrafici/IdFiscaleIVA/IdPaese","FatturaElettronicaHeader/TerzoIntermediarioOSoggettoEmittente/","DatiAnagrafici/IdFiscaleIVA/IdPaese"),
//     array("DatiAnagrafici/IdFiscaleIVA/IdCodice","FatturaElettronicaHeader/TerzoIntermediarioOSoggettoEmittente/","DatiAnagrafici/IdFiscaleIVA/IdCodice"),
//     array("DatiAnagrafici/CodiceFiscale","FatturaElettronicaHeader/TerzoIntermediarioOSoggettoEmittente/","DatiAnagrafici/CodiceFiscale"),
//     array("DatiAnagrafici/Anagrafica/Denominazione","FatturaElettronicaHeader/TerzoIntermediarioOSoggettoEmittente/","DatiAnagrafici/Anagrafica/Denominazione"),
//     array("DatiAnagrafici/Anagrafica/Nome","FatturaElettronicaHeader/TerzoIntermediarioOSoggettoEmittente/","DatiAnagrafici/Anagrafica/Nome"),
//     array("DatiAnagrafici/Anagrafica/Cognome","FatturaElettronicaHeader/TerzoIntermediarioOSoggettoEmittente/","DatiAnagrafici/Anagrafica/Cognome"),
//     array("DatiAnagrafici/Anagrafica/Titolo","FatturaElettronicaHeader/TerzoIntermediarioOSoggettoEmittente/","DatiAnagrafici/Anagrafica/Titolo"),
//     array("DatiAnagrafici/Anagrafica/CodEORI","FatturaElettronicaHeader/TerzoIntermediarioOSoggettoEmittente/","DatiAnagrafici/Anagrafica/CodEORI")
// );

// $header_1_6 = array(
//     array("SoggettoEmittente","FatturaElettronicaHeader/","SoggettoEmittente")
// );

// $body_2_1 = array(
//     array("DatiGeneraliDocumento/TipoDocumento","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/TipoDocumento"),
//     array("DatiGeneraliDocumento/Divisa","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/Divisa"),
//     array("DatiGeneraliDocumento/Data","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/Data"),
//     array("DatiGeneraliDocumento/Numero","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/Numero"),
//     array("DatiGeneraliDocumento/DatiBollo/BolloVirtuale","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/DatiBollo/BolloVirtuale"),
//     array("DatiGeneraliDocumento/DatiBollo/ImportoBollo","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/DatiBollo/ImportoBollo"),
//     array("DatiGeneraliDocumento/ImportoTotaleDocumento","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/ImportoTotaleDocumento"),
//     array("DatiGeneraliDocumento/Arrotondamento","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/Arrotondamento"),
//     array("DatiGeneraliDocumento/Art73","FatturaElettronicaBody/DatiGenerali/","DatiGeneraliDocumento/Art73"),
//     array("DatiTrasporto/DatiAnagraficiVettore/IdFiscaleIVA/IdPaese","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DatiAnagraficiVettore/IdFiscaleIVA/IdPaese"),
//     array("DatiTrasporto/DatiAnagraficiVettore/IdFiscaleIVA/IdCodice","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DatiAnagraficiVettore/IdFiscaleIVA/IdCodice"),
//     array("DatiTrasporto/DatiAnagraficiVettore/CodiceFiscale","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DatiAnagraficiVettore/CodiceFiscale"),
//     array("DatiTrasporto/DatiAnagraficiVettore/Anagrafica/Denominazione","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DatiAnagraficiVettore/Anagrafica/Denominazione"),
//     array("DatiTrasporto/DatiAnagraficiVettore/Anagrafica/Nome","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DatiAnagraficiVettore/Anagrafica/Nome"),
//     array("DatiTrasporto/DatiAnagraficiVettore/Anagrafica/Cognome","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DatiAnagraficiVettore/Anagrafica/Cognome"),
//     array("DatiTrasporto/DatiAnagraficiVettore/Anagrafica/Titolo","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DatiAnagraficiVettore/Anagrafica/Titolo"),
//     array("DatiTrasporto/DatiAnagraficiVettore/Anagrafica/CodEORI","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DatiAnagraficiVettore/Anagrafica/CodEORI"),
//     array("DatiTrasporto/DatiAnagraficiVettore/NumeroLicenzaGuida","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DatiAnagraficiVettore/NumeroLicenzaGuida"),
//     array("DatiTrasporto/MezzoTrasporto","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/MezzoTrasporto"),
//     array("DatiTrasporto/CausaleTrasporto","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/CausaleTrasporto"),
//     array("DatiTrasporto/NumeroColli","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/NumeroColli"),
//     array("DatiTrasporto/Descrizione","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/Descrizione"),
//     array("DatiTrasporto/UnitaMisuraPeso","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/UnitaMisuraPeso"),
//     array("DatiTrasporto/PesoLordo","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/PesoLordo"),
//     array("DatiTrasporto/PesoNetto","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/PesoNetto"),
//     array("DatiTrasporto/DataOraRitiro","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DataOraRitiro"),
//     array("DatiTrasporto/DataInizioTrasporto","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DataInizioTrasporto"),
//     array("DatiTrasporto/TipoResa","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/TipoResa"),
//     array("DatiTrasporto/IndirizzoResa/Indirizzo","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/IndirizzoResa/Indirizzo"),
//     array("DatiTrasporto/IndirizzoResa/NumeroCivico","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/IndirizzoResa/NumeroCivico"),
//     array("DatiTrasporto/IndirizzoResa/CAP","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/IndirizzoResa/CAP"),
//     array("DatiTrasporto/IndirizzoResa/Comune","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/IndirizzoResa/Comune"),
//     array("DatiTrasporto/IndirizzoResa/Provincia","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/IndirizzoResa/Provincia"),
//     array("DatiTrasporto/IndirizzoResa/Nazione","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/IndirizzoResa/Nazione"),
//     array("DatiTrasporto/DataOraConsegna","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/DataOraConsegna"),
//     array("DatiTrasporto/FatturaPrincipale/NumeroFatturaPrincipale","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/FatturaPrincipale/NumeroFatturaPrincipale"),
//     array("DatiTrasporto/FatturaPrincipale/DataFatturaPrincipale","FatturaElettronicaBody/DatiGenerali/","DatiTrasporto/FatturaPrincipale/DataFatturaPrincipale")
// );



?>