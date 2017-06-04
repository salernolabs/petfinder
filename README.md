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