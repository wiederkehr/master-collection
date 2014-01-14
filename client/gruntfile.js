module.exports = function(grunt) {

  // makes  grunt.loadNpmTasks('...') not needed
  require("matchdep").filterDev("grunt-*").forEach(grunt.loadNpmTasks);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    dirs: {
      src: 'public/js'
    },
    copy: {
      main: {
        files: [
          // includes files within path
          { expand: true, flatten: true, src: ['bower_components/backbone/backbone-min.js'], dest: 'public/js/lib'},
          { expand: true, flatten: true, src: ['bower_components/backbone/backbone-min.map'], dest: 'public/js/lib'},         
          { expand: true, flatten: true, src: ['bower_components/backbone-query-parameters/backbone.queryparams.js'], dest: 'public/js/lib'},
          { expand: true, flatten: true, src: ['bower_components/handlebars/handlebars.min.js'], dest: 'public/js/lib'},
          { expand: true, flatten: true, src: ['bower_components/jquery/jquery.min.js'], dest: 'public/js/lib'},
          { expand: true, flatten: true, src: ['bower_components/jquery/jquery.min.map'], dest: 'public/js/lib'},
          { expand: true, flatten: true, src: ['bower_components/underscore/underscore-min.js'], dest: 'public/js/lib'},
          { expand: true, flatten: true, src: ['bower_components/underscore/underscore-min.map'], dest: 'public/js/lib'},
          { expand: true, flatten: true, src: ['bower_components/normalize-css/normalize.css'], dest: 'public/css'},
          { expand: true, flatten: true, src:['bower_components/jslider/bin/jquery.slider.min.js'], dest: 'public/js/lib'},
          { expand: true, flatten: true, src:['bower_components/jslider/bin/jquery.slider.min.css'], dest: 'public/css'},
        ]
      }
    },

    // process html to set to minified versions
    processhtml: {
      dist: {
        files: {
          'index.html': ['dev/index.html']
        }
      }
    },

    // concat and minify js
    concat: {
      dist: {
        src: ['dev/js/*.js', 'dev/js/models/*.js', 'dev/js/collections/*.js', 'dev/js/views/*.js', 'dev/js/routers/*.js'],
        dest: 'public/js/app.js'
      }
    },

    // concat and minify css
    cssmin: {
      combine: {
        files: {
          'public/css/main.min.css': ['dev/css/*.css']
        }
      }
    },

    // uglify the js
    uglify: {
      options: {
        banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
      },
      dist: {
        files: {
          'public/js/app.min.js': ['<%= concat.dist.dest %>']
        }
      }
    },

    jshint: {
      files: ['gruntfile.js', 'dev/**/*.js'],
      options: {
        globals: {
          jQuery: true,
          console: true,
          module: true
        }
      }
    },

    watch: {
      files: ['<%= concat.dist.src %>', 'dev/css/*.css', 'public/data/*.json'],
      tasks: ['concat', 'uglify', 'cssmin', 'processhtml']
    }

  });

  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-processhtml');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-cssmin');

  grunt.registerTask('default', ['concat', 'uglify', 'cssmin', 'processhtml']);

};