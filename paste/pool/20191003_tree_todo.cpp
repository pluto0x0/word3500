#include <vector>
#include <cstdio>
#include <cstring>
#include <iostream>
#include <algorithm>
#define REP(i,a,b) for(int i = (a);i <= (b);i++)
#define PER(i,a,b) for(int i = (a);i >= (b);i--)
#define SF scanf
#define PF printf
#define N 100010
#define mid (((L[u])+(R[u]))>>1)
#define ls ((u)<<1)
#define rs (((u)<<1)|1)
using namespace std;
int n,m,clk = 0;
int p[N],q[N],out[N];
int fst[N],nxt[N<<1],to[N<<1],cnt = 0;
int L[N<<2],R[N<<2],tag[N<<2],sum[N<<2];
vector<pair<int,int> >v[N];
inline void addedge(int x,int y){
	nxt[++cnt] = fst[x], fst[x] = cnt, to[cnt] = y;
}
void dfs1(int u,int fa){
	p[u] = ++clk;
	for(int i = fst[u];i;i = nxt[i]){
		int v = to[i];
		if(v == fa) continue;
		dfs1(v,u);
	}
	q[u] = clk;
}
void pushup(int u){
	if(tag[u] > 0) sum[u] = R[u] - L[u] + 1;
	else if(L[u] == R[u]) sum[u] = 0;
	else sum[u] = sum[ls] + sum[rs];
}
void update(int u,int l,int r,int val){
	if(l == L[u] && r == R[u]){
		tag[u] += val;
		pushup(u);
		return;
	}
	else if(mid <= l) update(u,l,mid,val);
	else update(u,mid + 1,r,val);
	pushup(u);
}
void dfs(int u,int fa){
	for(auto i : v[u]) update(1,p[i.first],q[i.first],1),
					   update(1,p[i.second],q[i.second],1);
	out[u] = sum[1];
	if(v[u].size()) out[u]--;
	for(int i = fst[u];i;i = nxt[i]){
		int v = to[i];
		if(v == fa) continue;
		dfs(v,u);
	}
	for(auto i : v[u]) update(1,p[i.first],q[i.first],-1),
					   update(1,p[i.second],q[i.second],-1);
}
void build(int u,int l,int r){
	L[u] = l, R[u] = r; 
	if(l < r) build(ls,l,mid), build(rs,mid + 1,r);
}
int main()
{
	memset(fst,0,sizeof fst);
	memset(sum,0,sizeof sum);
	memset(tag,0,sizeof tag);
	cin>>n>>m;
	build(1,1,n);
	REP(i,1,n - 1){
		int x,y;
		SF("%d %d",&x,&y);
		addedge(x,y);
		addedge(y,x);
	}
	REP(i,1,m){
		int x,y;
		SF("%d %d",&x,&y);
		v[x].push_back(make_pair(x,y));
		v[y].push_back(make_pair(x,y));
	}
	dfs1(1,0);
	dfs(1,0);
	REP(i,1,n) PF("%d ",out[i]);
	return 0;
}