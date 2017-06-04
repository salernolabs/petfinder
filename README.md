# salernolabs/petfinder

This is an unofficial PHP Petfinder API SDK that uses the freely available [petfinder api](https://www.petfinder.com/developers/api-docs). Here are some important bits from their documentation that you should read before using this.

    Getting Started

    You will need an API key and secret to access the Petfinder API, which you can obtain by registering here. You will also be asked for the domain of the web site on which your applications will run. We do not currently use this information for restricting access, but we may do so in the future to protect your security information. Developers of commercial or high-volume sites and applications should refer to the restrictions below.
    Restrictions

    The following usage restrictions apply to users of the API:
    Total requests per day: 10,000
    Records per request: 1,000
    Maximum records per search: 2,000
    If your usage may exceed these limits, please contact us at api-help@petfinder.com.

When you have your API key and secret you can use this library.

This is built for an upcoming animal rescue site and we weren't happy with the current PHP based offerings for petfinder API libraries.

## Queries

All examples that follow assume you have a $configuration object built with your api key and secret.

### auth.getToken

    $request = new \SalernoLabs\Petfinder\Requests\Auth\GetToken($configuration);
    $data = $request->execute();

### breed.list

    $request = new \SalernoLabs\Petfinder\Requests\Breed\GetList($configuration);
    $data = $request
                ->setAnimal('dog')
                ->execute();

### pet.find

    $request = new \SalernoLabs\Petfinder\Requests\Pet\Find($configuration);
    $data = $request
                ->setAnimal('dog')
                ->setBreed('shnauzer')
                ->setSize('XL')
                ->setSex('M')
                ->setLocation('12345')
                ->setAge('Young')
                ->setCount(10)
                ->setOffset($lastOffset)
                ->setOutput('full')
                ->execute();

### pet.get

    $request = new \SalernoLabs\Petfinder\Requests\Pet\Get($configuration);
    $data = $request
                ->setId(12345)
                ->execute();

### pet.getRandom

    $request = new \SalernoLabs\Petfinder\Requests\Pet\GetRandom($configuration);
    $data = $request
                ->setAnimal('dog')
                ->setBreed('shnauzer')
                ->setSize('XL')
                ->setSex('M')
                ->setLocation('12345')
                ->setShelterId('NJ1234')
                ->setOutput('basic')
                ->execute();

### shelter.find

    $request = new \SalernoLabs\Petfinder\Requests\Shelter\Find($configuration);
    $data = $request
                ->setLocation('12345')
                ->setCount(10)
                ->setOffset($lastOffset)
                ->execute();

### shelter.get

    $request = new \SalernoLabs\Petfinder\Requests\Shelter\Get($configuration);
    $data = $request
                ->setId(12345)
                ->execute();

### shelter.getPets

    $request = new \SalernoLabs\Petfinder\Requests\Shelter\GetPets($configuration);
    $data = $request
                ->setId(12345)
                ->setCount(10)
                ->setOffset($lastOffset)
                ->execute();

### shelter.listByBreed

    $request = new \SalernoLabs\Petfinder\Requests\Shelter\ListByBreed($configuration);
    $data = $request
                ->setAnimal('dog')
                ->setBreed('shnauzer')
                ->setCount(10)
                ->setOffset($lastOffset)
                ->execute();

## still in development, these do not work yet!