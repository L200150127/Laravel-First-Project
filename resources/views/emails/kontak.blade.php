<h3>Anda Mendapat Email </h3>
<h5><small>Web MIM Pucangan</small></h5>
<h5></h5>
<div>
	{{ $comments }}	<br>
	@if ($phone)
			<span>Bisa dihubungi melalui nomor: {{ $phone }}</span> <br>
	@endif
	@if ($call_time)
			<span>Luang ketika {{ $call_time ? $call_time : 'Kapan Saja'}}</span>
	@endif
	
	
</div>

<p>Dikirim Oleh {{ $email }}</p>