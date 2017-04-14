//vue codes
export default {
  name: 'app',

  created: function () {
    const postData = {
      grant_type: 'password',
      client_id: 2,
      client_secret: 'iDMGsitUorXs3xMIfqIyq3Hm5JlchZqszFpAZLnr',
      username: 'sagar@gmail.com',
      password: 'password',
      scope: ''
    }

    this.$http.post('http://localhost:8000/oauth/token', postData)
    .then(response => {
      console.log(response)
      const header = {
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + response.body.access_token
      }
      this.$http.get('http://localhost:8000/api/user', {headers: header})
      .then(response => {
        console.log(response)
      })
    })
  }
}
//cors
class cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $domains = ['http://localhost:8080'];
        if (isset($request->server()['HTTP_ORIGIN'])) {
          $origin = $request->server()['HTTP_ORIGIN'];
          if (in_array($origin, $domains)) {
            header('Access-Control-Allow-Origin: '. $origin);
            header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
          }
        }
        return $next($request);
    }
}
