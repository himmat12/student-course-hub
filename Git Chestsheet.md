# Git Cheatsheet


## Git vs GitHub
`Git` is a version control tool which does actions in your code like pull, push, commit, staging files (`add`) for commit, creating new branches, merging branches and so on on your local machine (local repository). `Github` is a cloud-based platform where you can host you repository (project files) and share to other people around the world and work collaborately in the same project and manage your project. So, in simple word Git  is a tool to do actions in your code and GitHub is a cloud storage like google drive which hosts your repositories (project).
<br>


## Main git concepts
 - Clone ~ `git clone <url>`, in order to clone (download) your remote repository (the repo hosted in the cloud) to your local machine.
 - Add ~ `git add <file path>`, add changes in your working directory to the Git staging area.
 - Commit ~ `git commit -m "message"`
 - Pull ~ `git pull <branch>`, updates your local repository with the new changes from the remote repository.
 - Push ~ `git push -u origin <branch>`, push changes from your local repository to the remote repository (it's like uploading the new changes that you have made in your local machine).
 - Branch ~ `git checkout -b <new branch>` or `git checkout <existing branch>`, creating new branch and switching to existing branch respectively (branch is a seperate version of your project itself with different prupose like you create a new branch called `ui-branch` where you only work on the frontend part of the website and so on).
 - Stash ~ `git stash` used to save changes that are not ready to be committed yet, but you need to switch to another branch or perform some other tasks without committing or losing those changes. 
  - `git stash list` lists all the stashes you have saved. 
  - `git stash apply` applies the most recent stash to your working directory without removing it from the stash list.
  - `git stash apply stash@{1}` applies the stash at index 1 in the stash list. 
  - `git stash pop` applies the most recent stash to your working directory and removes it from the stash list. 
  - `git stash clear` removes all stashes from the stash list.
<br>


## Step by step guide

### Cloning the repo
 In order to clone the repo you need to follow this steps as shown below:
 - First move to your desired directory location `cd <path>` (remember linux module that we did in year one).
 - Then run `git clone https://github.com/web-development-DMU/web-project-the-a-team.git` command to clone our repo from github.
 - Once this cmdlet finsshed running check you dir you should have `web-project-the-a-team` dir on your specified file location. 
> Finally, we are done with cloning our repo from github.
<br>


### Commiting new changes from your local repository
 In order to commit the new changes from your local repo to remote repo you need to follow this steps as shown below:
 - First you need to have worked on something on your local repository (your code base on your machine).
 - Then our next step will be to `add` our all files with changes for staging before making `commit`. In order to do please refer to the [Main git concepts](#main-git-concepts).
 - Once we staged our changes (added our changed files to staging for commit) we need to run `git commit` cmdlet. In order to do please refer to the [Main git concepts](#main-git-concepts).
 - Then our final step will be to run a `git push` cmdlet which will push our commit with changes to the remote repository (github hosted repository). In order to do please refer to the [Main git concepts](#main-git-concepts).
 > Finally, we are done with pushing our commit with changes from our local repo to remote repo on github.
<br>

 ### Pulling new changes from remote repository to local repository
 In order to pull changes from remote repo to you local repo you need to follow these instructions shown beow:
 > NOTE: If you have existing changes made on your local repository then you need to first `stash` your changes and then follow the `pull` instructions shown below then only `apply` your `stash` back to your up to date codebase. For this please refer to [Main git concepts](#main-git-concepts). 
 - In order to pull changes from remote repo to your local repo run `git pull` cmdlet refer to [Main git concepts](#main-git-concepts). And you have got your new changes from remote repo to your local repo.
 
 > Finally, we are done with pulling our new changes from remote repo to our local repo on our local machine.


<br>

### _Made with love to help my dear teammates to ace this assignment. Feel free to drop me any queries regarding github and git._

