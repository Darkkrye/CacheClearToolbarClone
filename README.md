# CacheClearToolbar

## Install

### Download
* Download from GitHub

### Unzip Bundle
* Unzip Bundle,
* Rename folder to `CacheClearToolbar`
* Move Bundle to `'MySymfonyProject'/src/`

### Register into AppKernel
* Add the following code into AppKernel :

app/AppKernel.php :

    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
        [...]
        $bundles[] = new CacheClearToolbar\CacheClearToolbar();
    }

### Add to route file
* Add the following code into main route file :

app/config/routing.yml :

    cache_clear_toolbar:
        resource: "@CacheClearToolbar/Resources/config/routing.yml"
        prefix: /cache_clear_toolbar

### Reload
* Reload and enjoy !

## TODO !
 - [x] Create Web Debug Toolbar tool,
 - [ ] Add additional namespace,
 - [ ] Release to composer,
 - [ ] Change properties to only work in dev environment.
