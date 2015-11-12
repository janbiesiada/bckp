<?php

/**
 * TODO
 * - Implement Search
 * - Recfactor Database Table Names
 * - Opt-out content
 * - Long Posts
 * - URL Language Content
 * - Tutorials and Banners
 * - Vines and Youtube Video Support
 */
 
 
 /**
  * Main site routes
  */
 
// Site Content 
include('routes/content.php');

// Hide Content
include('routes/hide_content.php');

// User Profiles and Content 
include('routes/users.php');

// Accounts
include('routes/authentication.php');

// Account Recovery
include('routes/recovery.php');

// Account Verification
include('routes/verification.php');

// XHR Requests
include('routes/xhr.php');

// Newsletter Subscriptio
include('routes/news_letter.php');

// Session Settings
include('routes/session_settings.php');

// User Accounts Settings
include('routes/account_settings.php');

// Post Uplaods
include('routes/uploads.php');

// Votes
include('routes/votes.php');

// Comments 
include('routes/comments.php');

// Notifications
include('routes/notifications.php');

// Delete Content
include('routes/delete.php');

// Report Contet
include('routes/report.php');

// Search Functionality
include('routes/search.php');

/**
 * Admin Routes
 */
 
// Authentication
include('routes_admin/authentication.php');

// Administration
include('routes_admin/administration_tasks.php');

// Flagged Content
include('routes_admin/flagged_content.php');

// Other Management Functions
include('routes_admin/management.php');

 

