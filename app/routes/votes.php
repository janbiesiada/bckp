<?php

Route::group(array('before' => 'auth'), function(){
    
    
    /********************
     * Voting   (@Module)
     * 
     * @Module  (Post Votes)
     * @Module  (Comment Votes)
     * @Module  (Replies Vote)
     */
     
    /**
     * @Module (Vote)
     */
    Route::post('/vote',array(
        'as'    => 'post-vote',
        'uses'  => 'VotingController@vote'
    ));
    
    /**
     * @Module  (Post Votes)
     */
    Route::post('/post/vote',array(
        'as'    => 'vote',
        'uses'  => 'voteController@vote'
    ));
    
    /**
     * @Module  (Commenet Votes)
     */
    Route::post('/post/c-vote',array(
        'as'    => 'comment-post-vote',
        'uses'  => 'commentVoteController@commentVoting'
    ));
    
    /**
     * @Module  (Reply Votes)
     */
    Route::post('/post/reply-vote', array(
        'as'    => 'reply-vote',
        'uses'  => 'replyVoteController@repliesVoting'
    ));
    
});

?>