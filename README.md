# Cache of PHP


## What is it
working on cache issue on php project simple and easy way to apply your project...
[it's maybe useful]


## Installation
     use alim:
     php alim install Cache
     use git:
     git clone https://github.com/ifehrim/cache-case.git


### example files:

[work](./work.php)




### how to use ?

-  step:# use of Nexus:
   
        Nexus::on('file'); //can switch [file|redis|memcache|cookie|session]
        Nexus::set('key','val');
        if(Nexus::has('key')){
            print "key:".Nexus::get('key');
        }
        
        print Nexus::age('key');
        
    
-  step:# [File]:     
   
        File::set('key-f','val-f');
        if(File::has('key-f')){
            print "key-f:".File::get('key-f');
        }   
         
-  step:# [Cookie]:     
   
        Cookie::set('key-f','val-f');
        if(Cookie::has('key-f')){
            print "key-f:".Cookie::get('key-f');
        }
         
-  step:# [Session]:     
   
        Session::set('key-f','val-f');
        if(Session::has('key-f')){
            print "key-f:".Session::get('key-f');
        }
         
-  step:# [Redis]:     
   
        Redis::set('key-f','val-f');
        if(Redis::has('key-f')){
            print "key-f:".Redis::get('key-f');
        }
         
-  step:# [Memcache]:     
   
        Memcache::set('key-f','val-f');
        if(Memcache::has('key-f')){
            print "key-f:".Memcache::get('key-f');
        }
       



    
    

