using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Mathgame
{
    #region Scores
    public class Scores
    {
        #region Member Variables
        protected int _id;
        protected string _username;
        protected int _scores;
        protected DateTime _playtime;
        protected string _foto;
        #endregion
        #region Constructors
        public Scores() { }
        public Scores(string username, int scores, DateTime playtime, string foto)
        {
            this._username=username;
            this._scores=scores;
            this._playtime=playtime;
            this._foto=foto;
        }
        #endregion
        #region Public Properties
        public virtual int Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual string Username
        {
            get {return _username;}
            set {_username=value;}
        }
        public virtual int Scores
        {
            get {return _scores;}
            set {_scores=value;}
        }
        public virtual DateTime Playtime
        {
            get {return _playtime;}
            set {_playtime=value;}
        }
        public virtual string Foto
        {
            get {return _foto;}
            set {_foto=value;}
        }
        #endregion
    }
    #endregion
}