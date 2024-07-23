{{-- QUESTA è LA VIEW SU CUI POSSO VEDERE IL CONTENUTO DELLA EMAIL --}}

<h1>Ciao admin!</h1>
<p>
	Hai ricevuto un nuovo messaggio, ecco qui i dettagli:<br>
	Nome: {{ $lead->name }}<br>
	Email: {{ $lead->email }}<br>
	Messaggio:<br>
	{{ $lead->message }}
</p>
