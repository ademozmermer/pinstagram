# Pinstagram

Instagram mobil uygulamasında yapılan işlemlerin hemen hemen tümünü bir paket haline getirmeyi düşünüyorum. Zaman buldukça paketi geliştirmeye devam edeceğim. Şuan için yalnızca login çalışmakta ve ilerleyen zamanda 2 faktörlü kimlik doğrulamayıda eklemeyi düşünüyorum.
cookies klasöründe login olan kullanıcıların session ve çerezleri bulunmaktadır.

### Kurulum

Php sürümünüzün 7.2 ve yukarısı olması gerekiyor.

```sh
$ composer require ademozmermer/pinstagram
```

```sh
use AdemOzmermer\Auth\Auth;

$auth = new Auth('username', 'password', 'proxy');

print_r($auth->login());
```

### Parametreler


| Param | Açıklama |
| ------ | ------ |
| username | Instagram kullanıcı adınız |
| password | Instagram şifreniz |
| proxy | Proxy adresiniz eğer proxy yok ise boş bırakılabilir |

### Yapılacaklar

 - 2 faktörlü kimlik doğrulama
 - Kullanıcıyı takip etme
 - Video, Resim beğenme
 - Reels
 - Hikaye, Video İzleme

License
----

MIT
