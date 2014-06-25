# Workflow for searching Shuttle.app ssh connections.
This workflow searches [Shuttle.app](http://fitztrev.github.io/shuttle/) ssh connections and executes the returned command in your terminal (the selected terminal app in Alfred).  
The workflow doesn't actually require Shuttle to be running or installed. However, it uses the Shuttle configuration file (~/.shuttle.json) name, location, and format.  
Searching ~/.ssh/config hosts is not currently supported, the workflow only searches the hosts in ~/.shuttle.json.  